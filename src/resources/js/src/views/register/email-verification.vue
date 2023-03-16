<template>
    <div class="layout-px-spacing">
        <div v-if="!isLoaded"></div>
        <div v-else class="row justify-content-center">
            <!-- Content -->
            <div class="col-md-6 layout-top-spacing">
                <div class="panel">
                    <div class="panel-body">
                        <div class="d-flex justify-content-between">
                            <h3 style="padding-bottom: 1rem">
                                メールをご確認ください
                            </h3>
                        </div>
                        <div class="divider"></div>

                        <div style="color: red">
                            <div class="mb-4">{{ message }}</div>
                            <div class="mb-4">
                                認証リンクを記載したメールを送信しました。<br />
                                リンクをクリックして認証を完了させてください。
                            </div>
                            <div class="mb-4 text-center">
                                送信先のメールアドレス<br />
                                {{ email }}
                            </div>
                        </div>

                        <div>
                            もしメールが届かない場合は、迷惑メールフォルダをご確認ください。<br />
                            また、それでも見つからない場合は、メールアドレスをご確認のうえ、再度登録をお願いします。
                        </div>

                        <div class="text-center mt-5">
                            <router-link to="/login" v-slot="{ navigate }">
                                <button
                                    type="button"
                                    class="btn btn-info"
                                    :disabled="isSubmitting"
                                    @click="navigate"
                                >
                                    ログイン画面へ
                                </button>
                            </router-link>
                        </div>

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
            </div>
        </div>
    </div>
</template>

<script setup>
import "@/assets/sass/scrollspyNav.scss";
import "@/assets/sass/users/user-profile.scss";
import { useMeta } from "@/composables/use-meta";

useMeta({ title: "メールをご確認ください" });
</script>

<script>
export default {
    data() {
        return {
            isLoaded: false,
            message: "",
            prevUrl: "",
            email: "",
            isSubmitting: false,
        };
    },

    mounted() {
        this.message = window.history.state.message;
        this.prevUrl = window.history.state.prevUrl || "/login";
        this.email = window.history.state.email;

        this.isLoaded = true;
    },
    methods: {},
};
</script>
<style lang="scss" scoped></style>
