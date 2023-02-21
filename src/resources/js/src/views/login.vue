<template>
    <div class="layout-px-spacing">
        <div v-if="!isLoaded"></div>
        <div v-else class="row justify-content-center">
            <!-- Content -->
            <div class="col-md-6 layout-top-spacing">
                <div class="panel">
                    <div class="panel-body">
                        <div class="d-flex justify-content-between">
                            <h3 style="padding-bottom: 1rem">プロフィール</h3>
                        </div>
                        <div
                            style="
                                border: solid 0.5px gray;
                                margin-top: 1rem;
                                margin-bottom: 1rem;
                            "
                        ></div>

                        <!-- 変更フォーム -->
                        <Form
                            ref="form"
                            v-slot="{ errors }"
                            :validationSchema="schema"
                        >
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
                                style="
                                    border: solid 0.5px gray;
                                    margin-top: 1rem;
                                    margin-bottom: 1rem;
                                "
                            ></div>

                            <div
                                v-if="Object.keys(errors).length > 0"
                                class="error"
                                style="margin-bottom: 1rem"
                            >
                                入力項目を確認してください。
                            </div>
                            <!-- <div
                                    v-if="errorMessage"
                                    class="error"
                                    style="margin-bottom: 1rem"
                                >
                                    {{ errorMessage }}
                                </div> -->

                            <div>
                                <button
                                    type="button"
                                    class="btn btn-primary"
                                    :disabled="isSubmitting"
                                    @click="login"
                                >
                                    ログイン {{ counterStore.count }}
                                </button>
                            </div>
                        </Form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useCounterStore } from "@/store/counter";

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

const counterStore = useCounterStore();

useMeta({ title: "ログイン" });
</script>

<script>
const counterStore = useCounterStore();
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
        console.log("Component mounted.");
        this.isLoaded = true;
    },
    methods: {
        async login() {
            // const store = useStore();

            counterStore.increment();

            // console.log("store");
            // try {
            //     console.log("dispatch login1 ");
            //     await this.$store.dispatch("login", {
            //         email: form.email,
            //         password: form.password,
            //     });
            //     console.log("dispatch login2 ");
            //     this.errorMessage = "OK";
            //     // router.push("/");
            // } catch (err) {
            //     this.errorMessage = "NG";
            //     // this.errorMessage = err.message;
            // }
        },
    },
};
</script>
<style lang="scss" scoped>
.btn {
    margin-left: 0.5rem;
    margin-right: 0.5rem;
}

.error {
    color: red; // TODO: 後で共通化
}

.text-link {
    color: #0d95f6; // TODO: 後で共通化
}
</style>
