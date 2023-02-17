<template>
    <div class="layout-px-spacing">
        <div v-if="!isLoaded"></div>
        <div v-else class="row layout-spacing">
            <!-- Content -->
            <div class="col-sm-12 layout-top-spacing">
                <div class="user-profile layout-spacing">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="d-flex justify-content-between">
                                <h3 style="padding-bottom: 1rem">
                                    プロフィール
                                </h3>
                            </div>
                            <div
                                style="
                                    border: solid 0.5px gray;
                                    margin-top: 1rem;
                                    margin-bottom: 1rem;
                                "
                            ></div>
                            <div>
                                <h5>基本情報</h5>
                            </div>
                            <table class="basic-info">
                                <tr>
                                    <th>お名前：</th>
                                    <td>
                                        {{ form.lastName }}
                                        {{ form.firstName }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>生年月日：</th>
                                    <td>
                                        {{ form.birthday }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>住所：</th>
                                    <td style="white-space: pre-line">
                                        {{ profileAddress }}
                                    </td>
                                </tr>
                            </table>

                            <div
                                style="text-align: center; margin-bottom: 1rem"
                            >
                                <!-- TODO: 後でリンク先を変更 -->
                                <router-link to="/profile" class="text-link"
                                    >この変更は申請が必要です ></router-link
                                >
                            </div>

                            <!-- 変更フォーム -->
                            <Form
                                ref="form"
                                v-slot="{ errors }"
                                :validationSchema="schema"
                            >
                                <div>
                                    <label for="tel" class="col-form-label"
                                        >ご自身の連絡先</label
                                    >
                                    <Field
                                        name="tel"
                                        v-model="form.tel"
                                        type="text"
                                        class="form-control"
                                    />
                                    <ErrorMessage name="tel" class="error" />
                                </div>

                                <div>
                                    <label for="email" class="col-form-label"
                                        >メールアドレス</label
                                    >
                                    <Field
                                        v-model="form.email"
                                        name="email"
                                        type="text"
                                        class="form-control"
                                        placeholder=""
                                    />
                                    <ErrorMessage name="email" class="error" />
                                </div>

                                <div>
                                    <label for="sex" class="col-form-label"
                                        >性別</label
                                    >
                                    <Field
                                        v-slot="{ field }"
                                        v-model="form.sex"
                                        name="sex"
                                        type="radio"
                                    >
                                        <div class="input-radio">
                                            <div
                                                v-for="option in sexTypeOptions"
                                                style="display: inline"
                                            >
                                                <input
                                                    type="radio"
                                                    name="sex"
                                                    v-bind="field"
                                                    value="1"
                                                    :id="option.key"
                                                />
                                                <label
                                                    :for="option.key"
                                                    class="col-form-label"
                                                    >{{ option.name }}</label
                                                >
                                            </div>
                                        </div>
                                    </Field>

                                    <ErrorMessage name="sex" class="error" />
                                </div>

                                <div>
                                    <label
                                        for="nearestStation"
                                        class="col-form-label"
                                        >最寄り駅</label
                                    >
                                    <Field
                                        v-model="form.nearestStation"
                                        name="nearestStation"
                                        type="text"
                                        class="form-control"
                                        placeholder=""
                                    />
                                    <ErrorMessage
                                        name="nearestStation"
                                        class="error"
                                    />
                                </div>

                                <div>
                                    <label
                                        for="selfIntro"
                                        class="col-form-label"
                                        >自己紹介</label
                                    >
                                    <Field
                                        v-slot="{ field, errors }"
                                        v-model="form.selfIntro"
                                        name="selfIntro"
                                    >
                                        <textarea
                                            v-bind="field"
                                            name="selfIntro"
                                            style="
                                                display: block;
                                                width: 100%;
                                                height: 120px;
                                            "
                                        />
                                    </Field>
                                    <ErrorMessage
                                        name="selfIntro"
                                        class="error"
                                    />
                                </div>

                                <div style="margin-top: 2rem">
                                    <h5>プロフィール写真</h5>
                                </div>
                                <div>
                                    <div style="margin-bottom: 1rem">
                                        フォーマット： JPG / JPEG / GIF / PNG
                                    </div>

                                    <img
                                        v-if="form.photoName"
                                        :src="form.photoName"
                                        class="profile-photo"
                                    />
                                    <div
                                        v-else
                                        class="profile-photo"
                                        style="background-color: gray"
                                    ></div>
                                    <input
                                        ref="profilePhotoFile"
                                        type="file"
                                        class="form-control"
                                        style="margin-top: 1rem"
                                        placeholder=""
                                        :onchange="onChangeProfilePhotoFile"
                                    />
                                </div>

                                <div style="margin-top: 2rem">
                                    <h5>緊急連絡先</h5>
                                </div>

                                <div>
                                    ご家族など緊急時に連絡がつく方をご入力ください。
                                </div>

                                <div>
                                    <label
                                        for="emergencyContactName"
                                        class="col-form-label"
                                        >緊急連絡先のお名前</label
                                    >
                                    <Field
                                        v-model="form.emergencyContactName"
                                        name="emergencyContactName"
                                        type="text"
                                        class="form-control"
                                        placeholder=""
                                    />
                                    <ErrorMessage
                                        name="emergencyContactName"
                                        class="error"
                                    />
                                </div>

                                <div>
                                    <label
                                        for="emergencyContactName"
                                        class="col-form-label"
                                        >ご自身との関係</label
                                    >
                                    <Field
                                        v-model="form.emergencyContactRelation"
                                        name="emergencyContactRelation"
                                        type="text"
                                        class="form-control"
                                        placeholder=""
                                        required="true"
                                    />
                                    <ErrorMessage
                                        name="emergencyContactRelation"
                                        class="error"
                                    />
                                </div>

                                <div>
                                    <label
                                        for="emergencyContactTel"
                                        class="col-form-label"
                                        >緊急連絡先の電話番号</label
                                    >
                                    <Field
                                        v-model="form.emergencyContactTel"
                                        name="emergencyContactTel"
                                        type="text"
                                        class="form-control"
                                        placeholder=""
                                    />
                                    <ErrorMessage
                                        name="emergencyContactTel"
                                        class="error"
                                    />
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
                                <div
                                    v-if="errorMessage"
                                    class="error"
                                    style="margin-bottom: 1rem"
                                >
                                    {{ errorMessage }}
                                </div>

                                <div>
                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        :disabled="isSubmitting"
                                        @click="saveProfile"
                                    >
                                        保存
                                    </button>
                                </div>
                            </Form>
                        </div>
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
import { Validation } from "@/utils/validation";
import { ErrorMessage, Field, Form } from "vee-validate";
import * as yup from "yup";

const schema = yup.object({
    tel: Validation.Required,
    email: Validation.Required,
    sex: Validation.Required,
    nearestStation: Validation.Required,
    selfIntro: Validation.Required,
    emergencyContactName: Validation.Required,
    emergencyContactRelation: Validation.Required,
    emergencyContactTel: Validation.Required,
});

useMeta({ title: "プロフィール" });
</script>

<script>
export default {
    data() {
        return {
            isLoaded: false,
            isSubmitting: false,
            errorMessage: "",
            form: {
                lastName: "",
                firstName: "",
                birthday: "",
                zipcode: "",
                tel: "",
                email: "",
                sex: "",
                photoName: "",
                nearestStation: "",
                selfIntro: "",
                emergencyContactName: "",
                emergencyContactRelation: "",
                emergencyContactTel: "",
            },
            profilePhotoFile: null,
            profileAddress: "",
            sexTypeOptions: [
                { name: "女性", value: "1", key: "woman" },
                { name: "男性", value: "2", key: "man" },
                { name: "その他", value: "3", key: "other" },
            ],
        };
    },
    async mounted() {
        await this.fetchProfile();
        this.isLoaded = true;
    },
    methods: {
        async fetchProfile() {
            var res = await ApiClient.getProfile();
            if (res.isError) {
                this.errorMessage = CommonMessage.Error;
                return;
            }

            if (res.data) {
                this.form = res.data;
                this.profileAddress = `〒${this.form.zipcode}\n${this.form.city}${this.form.street}${this.form.street}`;
            }
        },
        async saveProfile() {
            this.errorMessage = "";
            this.isSubmitting = true;
            try {
                const { valid } = await this.$refs.form.validate();
                if (!valid) return;

                var res = await ApiClient.updateProfile(this.form);
                if (res.isError) {
                    // TODO: 後でトーストへ変更
                    errorMessage = CommonMessage.FailedTo("プロフィールの更新");
                    return;
                }

                await this.fetchProfile();

                // プロフィール画像の更新
                if (this.profilePhotoFile) {
                    var res = await ApiClient.updateProfilePhoto(
                        this.profilePhotoFile
                    );
                    if (res.isError) {
                        errorMessage =
                            CommonMessage.FailedTo("プロフィール画像の更新");
                        return;
                    }
                    this.$refs.profilePhotoFile.value = "";
                    this.profilePhotoFile = null;
                }
            } finally {
                this.isSubmitting = false;
            }
        },
        onChangeProfilePhotoFile(e) {
            if (e.target.files.length === 0) return;
            this.profilePhotoFile = e.target.files[0];
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

.basic-info {
    margin-bottom: 1rem;
    th {
        width: 100px;
        font-weight: normal;
    }
}
.input-radio {
    input[type="radio"] {
        margin-right: 0.5rem;
        margin-left: 0.5rem;
    }
    label {
        margin: 0;
        padding: 0;
    }
}
.profile-photo {
    height: 200px;
    width: 200px;
    object-fit: contain;
    margin: auto;
    display: block;
}
</style>
