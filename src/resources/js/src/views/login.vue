<template>
    <div class="layout-px-spacing">
        <div v-if="!isLoaded"></div>
        <div v-else class="row justify-content-center">
            <!-- Content -->
            <div class="col-md-6 layout-top-spacing">
                <div class="panel">
                    <div class="panel-body">
                        <div class="d-flex justify-content-between">
                            <h3 style="padding-bottom: 1rem">ログイン</h3>
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

                            <div>
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
                                class="checkbox-info custom-control custom-checkbox mt-3 mb-5"
                            >
                                <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    id="chk_info"
                                    :checked="rememberLoggedIn"
                                    v-model="rememberLoggedIn"
                                />
                                <label
                                    class="custom-control-label color-gray"
                                    for="chk_info"
                                >
                                    ログイン状態を記録する
                                </label>
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
                                    @click="login"
                                >
                                    ログイン
                                </button>
                            </div>

                            <div class="text-center mt-4">
                                <a href="#" class="text-link"
                                    >パスワードを忘れた場合 ＞</a
                                >
                            </div>
                        </Form>

                        <div class="divider"></div>

                        <div class="text-center mt-4">
                            <a href="#" class="text-link">新規登録へ ＞</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { userUserStore } from "@/store/user";
import { storage } from "@/utils/storage";

import ApiClient from "@/api/api-client";
import "@/assets/sass/scrollspyNav.scss";
import "@/assets/sass/users/user-profile.scss";
import { useMeta } from "@/composables/use-meta";
import { Validation } from "@/utils/validation";
import { ErrorMessage, Field, Form } from "vee-validate";
import * as yup from "yup";

const schema = yup.object({
    email: Validation.Required,
    password: Validation.Required,
});

useMeta({ title: "ログイン" });
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
            rememberLoggedIn: false,
        };
    },
    mounted() {
        console.log("Component mounted.");

        this.rememberLoggedIn = storage.getRememberLoggedIn();
        console.log("this.rememberLoggedIn", this.rememberLoggedIn);

        this.isLoaded = true;
    },
    methods: {
        async login() {
            var isOk = await userStore.loginByEmail({
                email: this.form.email,
                password: this.form.password,
            });
            if (!isOk) {
                this.errorMessage =
                    "ログインに失敗しました。\nメールアドレスまたはパスワードが間違っています。";
                return;
            }

            // TODO: テスト用ログ
            console.log(
                "debug accessToken",
                userStore.userCredential.accessToken
            );

            // login
            var res = await ApiClient.authLogin(
                userStore.userCredential.accessToken
            );
            if (res.isError) {
                console.error(res.data);
                this.errorMessage = "ログインに失敗しました。";
                return;
            }

            var userToken = res.data["userToken"];
            // TODO: テスト用ログ
            console.log("debug userToken", userToken);

            storage.setUserToken(userToken, this.rememberLoggedIn);
            storage.setRememberLoggedIn(this.rememberLoggedIn);

            // TODO: テストコード
            res = await ApiClient.getAuthUser();
            if (res.isError) {
                console.error(res.data);
                this.errorMessage = "ユーザの取得に失敗しました。";
                return;
            }
            console.log("debug user", res.data);

            //TODO: 現在はログイン後、プロフィール画面へ遷移するようにしているが、後で変更
            this.$router.push({ path: "/profile" });
        },
    },
};
</script>
<style lang="scss" scoped></style>
