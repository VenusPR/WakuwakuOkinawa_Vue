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
                                ようこそワクワクおきなわへ
                            </h3>
                        </div>
                        <div class="divider"></div>

                        <!-- フォーム -->
                        <Form ref="form" :validationSchema="schema">
                            <div>
                                <label
                                    :for="form.lastName"
                                    class="col-form-label"
                                    >お名前（姓）</label
                                >
                                <Field
                                    v-model="form.lastName"
                                    :name="lastName"
                                    type="text"
                                    class="form-control"
                                />
                                <ErrorMessage :name="lastName" class="error" />
                            </div>
                            <div>
                                <label
                                    :for="form.firstName"
                                    class="col-form-label"
                                    >お名前（名）</label
                                >
                                <Field
                                    v-model="form.firstName"
                                    :name="firstName"
                                    type="text"
                                    class="form-control"
                                />
                                <ErrorMessage :name="firstName" class="error" />
                            </div>
                            <div>
                                <label
                                    :for="form.lastKana"
                                    class="col-form-label"
                                    >かな（姓）</label
                                >
                                <Field
                                    v-model="form.lastKana"
                                    :name="lastKana"
                                    type="text"
                                    class="form-control"
                                    placeholder=""
                                />
                                <ErrorMessage :name="lastKana" class="error" />
                            </div>
                            <div>
                                <label
                                    :for="form.firstKana"
                                    class="col-form-label"
                                    >かな（名）</label
                                >
                                <Field
                                    v-model="form.firstKana"
                                    :name="firstKana"
                                    type="text"
                                    class="form-control"
                                    placeholder=""
                                />
                                <ErrorMessage :name="firstKana" class="error" />
                            </div>
                            <div>
                                <label
                                    :for="form.birthday"
                                    class="col-form-label"
                                    >生年月日</label
                                >
                                <YmdField
                                    :value="form.birthday"
                                    :name="birthday"
                                    @change="
                                        (value) => {
                                            onChangeBirthday(index, value);
                                        }
                                    "
                                ></YmdField>
                            </div>
                            <div>
                                <label :for="form.sex" class="col-form-labe"
                                    >性別</label
                                >

                                <Field
                                    v-slot="{ field }"
                                    v-model="form.sex"
                                    :name="sex"
                                    type="radio"
                                >
                                    <div class="input-radio">
                                        <div
                                            v-for="option in sexTypeOptions"
                                            style="display: inline"
                                            :key="option.value"
                                        >
                                            <input
                                                type="radio"
                                                :name="sex"
                                                v-bind="field"
                                                :value="option.value"
                                                :id="option.key + index"
                                                :checked="
                                                    form.sex == option.value
                                                "
                                            />
                                            <label
                                                :for="option.key + index"
                                                class="col-form-label"
                                                >{{ option.name }}</label
                                            >
                                        </div>
                                    </div>
                                </Field>
                                <ErrorMessage :name="sex" class="error" />
                            </div>

                            <div>
                                <label :for="form.tel" class="col-form-label"
                                    >ご連絡先の電話番号</label
                                >
                                <Field
                                    v-model="form.tel"
                                    :name="tel"
                                    type="text"
                                    class="form-control"
                                />
                                <ErrorMessage :name="tel" class="error" />
                            </div>

                            <!-- 住所 -->

                            <div>
                                <label
                                    :for="form.zipcode"
                                    class="col-form-label"
                                    >郵便番号</label
                                >
                                <Field
                                    v-model="form.zipcode"
                                    :name="zipcode"
                                    type="text"
                                    class="form-control"
                                />
                                <ErrorMessage :name="zipcode" class="error" />
                            </div>
                            <div>
                                <label
                                    :for="form.prefectureId"
                                    class="col-form-label"
                                    >都道府県</label
                                >
                                <Field
                                    v-model="form.prefectureId"
                                    :name="prefecture"
                                    type="text"
                                    class="form-control"
                                />
                                <ErrorMessage
                                    :name="prefecture"
                                    class="error"
                                />
                            </div>
                            <div>
                                <label :for="form.city" class="col-form-label"
                                    >市区郡</label
                                >
                                <Field
                                    v-model="form.city"
                                    :name="city"
                                    type="text"
                                    class="form-control"
                                />
                                <ErrorMessage :name="city" class="error" />
                            </div>
                            <div>
                                <label :for="form.street" class="col-form-label"
                                    >町村名および番地</label
                                >
                                <Field
                                    v-model="form.street"
                                    :name="street"
                                    type="text"
                                    class="form-control"
                                />
                                <ErrorMessage :name="street" class="error" />
                            </div>
                            <div>
                                <label
                                    :for="form.building"
                                    class="col-form-label"
                                    >建物名・部屋番号</label
                                >
                                <Field
                                    v-model="form.building"
                                    :name="building"
                                    type="text"
                                    class="form-control"
                                />
                                <ErrorMessage :name="building" class="error" />
                            </div>

                            <!-- エラーメッセージ -->
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
                lastName: "",
                firstName: "",
                lastKana: "",
                firstKana: "",
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

                // メールアドレスの有効性チェック
                var res = await ApiClient.getAuthEmailAvailability(
                    this.form.email
                );
                if (res.isError) {
                    this.errorMessage =
                        CommonMessage.FailedTo("メールアドレスの確認");
                    return;
                }
                if (!res.data.isAvailable) {
                    this.errorMessage =
                        "このメールアドレスはすでに登録済みです。";
                    return;
                }

                // // 登録
                // var success = await userStore.createUserByEmail({
                //     email: this.form.email,
                //     password: this.form.password,
                // });
                // if (!success) {
                //     this.errorMessage = "新規登録に失敗しました。";
                //     return;
                // }

                // ログイン
                var res = await ApiClient.authLogin(
                    userStore.userCredential.accessToken
                );
                if (res.isError) {
                    console.error(res.data);
                    this.errorMessage = "ログインに失敗しました。";
                    return;
                }

                storage.setUserToken(userToken, this.rememberLoggedIn);
                storage.setRememberLoggedIn(this.rememberLoggedIn);
            } finally {
                this.isSubmitting = false;
            }
        },
    },
};
</script>
<style lang="scss" scoped></style>
