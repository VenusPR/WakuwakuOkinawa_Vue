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

                        <!-- ログインフォーム -->
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
                            <div class="mb-5">
                                <label for="password" class="col-form-label"
                                    >パスワード</label
                                >
                                <Field
                                    name="password"
                                    v-model="form.password"
                                    type="password"
                                    class="form-control"
                                />
                                <ErrorMessage name="password" class="error" />
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
                                    メールアドレスで新規登録
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
import { userUserStore } from "@/store/user";
import { Validation } from "@/utils/validation";
import { ErrorMessage, Field, Form } from "vee-validate";
import * as yup from "yup";

const schema = yup.object({
    email: Validation.Required,
    password: Validation.Required,
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
            },
        };
    },
    mounted() {
        this.isLoaded = true;
    },
    methods: {
        async register() {
            this.errorMessage = "";
            const { valid } = await this.$refs.form.validate();
            if (!valid) return;
            try {
                this.isSubmitting = true;
                // var res = await userStore.existsEmail(this.form.email);
                // if (res.isError) {
                //     this.errorMessage =
                //         CommonMessage.FailedTo("メールアドレスの確認");
                //     console.error(res.data);
                //     return;
                // }
                // if (!res.data.isAvailable) {
                //     this.errorMessage =
                //         "このメールアドレスはすでに登録済みです。";
                //     return;
                // }
                var res = await ApiClient.getAuthEmailAvailability(
                    this.form.email
                );
                console.log(res);
                if (res.isError) {
                    this.errorMessage =
                        CommonMessage.FailedTo("メールアドレスの確認");
                    console.error(res.data);
                    return;
                }
                if (!res.data.isAvailable) {
                    this.errorMessage =
                        "このメールアドレスはすでに登録済みです。";
                    return;
                }

                // var isOk = await userStore.createUserByEmail({
                //     email: this.form.email,
                //     password: this.form.password,
                // });
                // if (!isOk) {
                //     this.errorMessage =
                //         CommonMessage.FailedTo("アカウントの登録");
                //     return;
                // }
            } finally {
                this.isSubmitting = false;
            }
        },
    },
};
</script>
<style lang="scss" scoped></style>
