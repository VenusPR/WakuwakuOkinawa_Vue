<template>
    <div class="layout-px-spacing">
        <div v-if="!isLoaded"></div>
        <div v-else class="row justify-content-center">
            <!-- Content -->
            <div class="col-md-6 layout-top-spacing">
                <div class="panel">
                    <div class="panel-body">
                        <div class="d-flex justify-content-between">
                            <h3 style="padding-bottom: 1rem">新規登録</h3>
                        </div>
                        <div class="divider"></div>

                        <!-- 新規登録 -->
                        <!-- フォーム -->
                        <Form ref="form" :validationSchema="schema">
                            <div>
                                <label for="email" class="col-form-label"
                                    >メールアドレス</label
                                >
                                <Field
                                    name="email"
                                    v-model="form.email"
                                    type="text"
                                    class="form-control"
                                />
                                <ErrorMessage name="email" class="error" />
                            </div>
                            <div>
                                <label for="password" class="col-form-label"
                                    >パスワード (半角英数字8文字以上)</label
                                >
                                <Field
                                    name="password"
                                    v-model="form.password"
                                    type="password"
                                    class="form-control"
                                />
                                <ErrorMessage name="password" class="error" />
                            </div>
                            <div class="mb-5">
                                <label
                                    for="passwordConfirm"
                                    class="col-form-label"
                                    >パスワード確認</label
                                >
                                <Field
                                    name="passwordConfirm"
                                    v-model="form.passwordConfirm"
                                    type="password"
                                    class="form-control"
                                />
                                <ErrorMessage
                                    name="passwordConfirm"
                                    class="error"
                                />
                            </div>

                            <div
                                v-if="errorMessage"
                                class="error mx-auto"
                                style="margin-bottom: 1rem"
                            >
                                {{ errorMessage }}
                            </div>

                            <div class="text-center">
                                <button
                                    type="button"
                                    class="btn btn-info"
                                    :disabled="isSubmitting"
                                    @click="register"
                                >
                                    新規登録
                                </button>
                            </div>

                            <div class="text-center mt-5">
                                <router-link to="/login" v-slot="{ navigate }">
                                    <button
                                        type="button"
                                        class="btn btn-dark"
                                        :disabled="isSubmitting"
                                        @click="navigate"
                                    >
                                        前へ戻る
                                    </button>
                                </router-link>
                            </div>
                        </Form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import ApiClient from "@/api/api-client";
import "@/assets/sass/scrollspyNav.scss";
import "@/assets/sass/users/user-profile.scss";
import { useMeta } from "@/composables/use-meta";
import { CommonMessage } from "@/messages/common-message";
import { userUserStore } from "@/store/user";
import { Validation } from "@/utils/validation";
import { ErrorMessage, Field, Form } from "vee-validate";
import * as yup from "yup";

const schema = yup.object({
    email: Validation.Email,
    password: Validation.Password,
    passwordConfirm: yup
        .string()
        .oneOf([yup.ref("password")], "パスワードが一致していません。"),
});

useMeta({ title: "新規登録" });
</script>

<script>
const userStore = userUserStore();

export default {
    data() {
        return {
            isLoaded: false,
            isSubmitting: false,
            errorMessage: "",
            form: {
                email: "",
                password: "",
                passwordConfirm: "",
            },
        };
    },
    mounted() {
        this.isLoaded = true;
    },
    methods: {
        async check() {
            var success = await userStore.sendEmailVerification(
                this.form.email
            );
            if (!success) {
                this.errorMessage =
                    CommonMessage.FailedTo("メールアドレスの確認");
                return;
            }
            this.errorMessage = "OK";
        },
        async register() {
            this.errorMessage = "";
            const { valid } = await this.$refs.form.validate();
            if (!valid) return;
            try {
                this.isSubmitting = true;

                // メールアドレスの有効性チェック
                var res = await ApiClient.getAuthEmailAvailability(
                    this.form.email
                );
                if (res.isError) {
                    console.log("res", res);
                    this.errorMessage =
                        CommonMessage.FailedTo("メールアドレスの確認");
                    return;
                }
                if (!res.data.isAvailable) {
                    this.errorMessage =
                        "このメールアドレスはすでに登録済みです。";
                    return;
                }

                // 登録
                var createRes = await userStore.createUserByEmail({
                    email: this.form.email,
                    password: this.form.password,
                });
                if (createRes.error) {
                    if (createRes.error.code == "auth/email-already-in-use") {
                        // メールアアドレスがすでに登録済みのため、
                        // パスワードリセットメールを送信
                        var success = await userStore.sendPasswordResetEmail({
                            email: this.form.email,
                        });
                        if (!success) {
                            this.errorMessage =
                                "メールアドレスがすでに登録済みです。\nパスワードの再設定に失敗しました。";
                            return;
                        }

                        this.$router.push({
                            path: "/password-reset",
                            state: {
                                message: "メールアドレスがすでに登録済みです。",
                                prevUrl: "/register",
                                email: this.form.email,
                                phase: 2,
                            },
                        });
                        return;
                    } else {
                        this.errorMessage = CommonMessage.FailedTo("新規登録");
                    }
                    return;
                }

                // メールアドレスの確認
                var firebaseUser = createRes.user;
                var success = await userStore.sendEmailVerification({
                    firebaseUser: firebaseUser,
                });
                if (!success) {
                    this.errorMessage =
                        CommonMessage.FailedTo(
                            "メールアドレス確認メールの送信"
                        );
                    return;
                }

                this.$router.push({
                    path: "/register/email-verification",
                    state: {
                        message: "",
                        prevUrl: "/register",
                        email: this.form.email,
                    },
                });
            } finally {
                this.isSubmitting = false;
            }
        },
    },
};
</script>
<style lang="scss" scoped></style>
