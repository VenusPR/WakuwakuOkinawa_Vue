<template>
    <div class="layout-px-spacing">
        <div v-if="!isLoaded"></div>
        <div v-else class="row justify-content-center">
            <!-- Content -->
            <div class="col-md-6 layout-top-spacing">
                <!-- 送信 -->
                <div v-if="phase == 1" class="panel">
                    <div class="panel-body">
                        <div class="d-flex justify-content-between">
                            <h3 style="padding-bottom: 1rem">
                                パスワード再設定
                            </h3>
                        </div>
                        <div class="divider"></div>

                        <div class="mb-4">
                            ご登録したメールアドレスを入力してください。
                            パスワードを再設定するメールを送信します。
                        </div>

                        <!-- フォーム -->
                        <Form ref="form" :validationSchema="schema">
                            <div class="mb-4">
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
                                    @click="sendResetLink"
                                >
                                    再設定リンクを送信
                                </button>
                            </div>
                        </Form>

                        <div class="text-center mt-5">
                            <router-link :to="prevUrl" v-slot="{ navigate }">
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
                    </div>
                </div>
                <!-- 完了 -->
                <div v-if="phase == 2" class="panel">
                    <div class="panel-body">
                        <div class="d-flex justify-content-between">
                            <h3 style="padding-bottom: 1rem">
                                パスワード再設定メールを送信しました
                            </h3>
                        </div>
                        <div class="divider"></div>

                        <div v-if="message" class="mb-4">
                            {{ message }}
                        </div>

                        <div class="mb-4">
                            メールアドレスへ再設定リンクを送信しました。
                            しばらく待っても届かない場合は、下のボタンから
                            再送信してみてください。
                        </div>
                        <div class="mb-4 text-center">
                            送信先のメールアドレス<br />
                            {{ form.email }}
                        </div>

                        <!-- フォーム -->
                        <div class="text-center">
                            <button
                                type="button"
                                class="btn btn-info"
                                :disabled="isSubmitting"
                                @click="showInput"
                            >
                                再送信
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { userUserStore } from "@/store/user";

import "@/assets/sass/scrollspyNav.scss";
import "@/assets/sass/users/user-profile.scss";
import { useMeta } from "@/composables/use-meta";
import { Validation } from "@/utils/validation";
import { ErrorMessage, Field, Form } from "vee-validate";
import * as yup from "yup";

const schema = yup.object({
    email: Validation.Required,
});

useMeta({ title: "パスワード再設定" });
</script>

<script>
import { useRouter } from "vue-router";
const userStore = userUserStore();
const router = useRouter();

export default {
    data() {
        return {
            isLoaded: false,
            isSubmitting: false,
            phase: 1,
            message: "",
            prevUrl: "",
            errorMessage: "",
            form: {
                email: "",
            },
        };
    },
    mounted() {
        this.phase = window.history.state.phase || 1;
        this.message = window.history.state.message;
        this.prevUrl = window.history.state.prevUrl || "/login";
        this.form.email = window.history.state.email;

        console.log("this.prevUrl", this.prevUrl, this.form.email);

        this.isLoaded = true;
    },
    methods: {
        async sendResetLink() {
            this.errorMessage = "";
            this.infoMessage = "";
            const { valid } = await this.$refs.form.validate();
            if (!valid) return;
            try {
                this.isSubmitting = true;

                var isOk = await userStore.resetPassword({
                    email: this.form.email,
                });
                if (!isOk) {
                    this.errorMessage =
                        "パスワードのリセットに失敗しました。\nメールアドレスが正しいか確認してください。";
                    return;
                }
                this.phase = 2;
            } finally {
                this.isSubmitting = false;
            }
        },
        showInput() {
            this.phase = 1;
        },
    },
};
</script>
<style lang="scss" scoped></style>
