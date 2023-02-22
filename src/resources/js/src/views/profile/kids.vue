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
                                    お子様情報
                                </h3>
                                
                            </div>
                            <div>シッターサービスをご利用される方はこちらのお子様情報をご入力ください。</div>
                            <div
                                style="
                                    border: solid 0.5px gray;
                                    margin-top: 1rem;
                                    margin-bottom: 1rem;
                                "
                            ></div>
                            <div>
                                <h5>お子様(おひとり目)</h5>
                            </div>

                            <!-- 新規作成/編集フォーム -->
                            <Form
                                ref="form"
                                v-slot="{ errors }"
                                :validationSchema="schema"
                            >
                                <div v-if="isInputMode">
                                    <div>
                                        <label
                                            for="email"
                                            class="col-form-label"
                                            >お名前（姓）</label
                                        >
                                        <Field
                                            name="lastName"
                                            v-model="form.lastName"
                                            type="text"
                                            class="form-control"
                                        />
                                        <ErrorMessage
                                            name="lastName"
                                            class="error"
                                        />
                                        <label
                                            for="email"
                                            class="col-form-label"
                                            >お名前（名）</label
                                        >
                                        <Field
                                            name="firstName"
                                            v-model="form.firstName"
                                            type="text"
                                            class="form-control"
                                        />
                                        <ErrorMessage
                                            name="firstName"
                                            class="error"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="email"
                                            class="col-form-label"
                                            >かな（姓）</label
                                        >
                                        <Field
                                            v-model="form.lastKana"
                                            name="lastKana"
                                            type="text"
                                            class="form-control"
                                            placeholder=""
                                            required="true"
                                        />
                                        <ErrorMessage
                                            name="lastKana"
                                            class="error"
                                        />
                                        <label
                                            for="email"
                                            class="col-form-label"
                                            >かな（名）</label
                                        >
                                        <Field
                                            v-model="form.firstKana"
                                            name="firstKana"
                                            type="text"
                                            class="form-control"
                                            placeholder=""
                                            required="true"
                                        />
                                        <ErrorMessage
                                            name="firstKana"
                                            class="error"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="email"
                                            class="col-form-label"
                                            >生年月日</label
                                        >
                                        <Field
                                            v-model="form.birthday"
                                            name="birthday"
                                            type="text"
                                            class="form-control"
                                            placeholder=""
                                            required="true"
                                        />
                                        <ErrorMessage
                                            name="birthday"
                                            class="error"
                                        />
                                    </div>
                                    <div>
                                        <label for="sex" class="col-form-label"
                                        >性別</label>

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
                                                :key="option.value"
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
                                            for="allergy"
                                            class="col-form-label"
                                            >アレルギー</label
                                        >
                                        <Field
                                            v-slot="{ field }"
                                            v-model="form.allergy"
                                            name="allergy"
                                        >
                                            <textarea
                                                v-bind="field"
                                                name="allergy"
                                                style="
                                                    display: block;
                                                    width: 100%;
                                                    height: 120px;
                                                "
                                            />
                                        </Field>
                                        <ErrorMessage
                                            name="allergy"
                                            class="error"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="otherNotes"
                                            class="col-form-label"
                                            >その他特記事項</label
                                        >
                                        <Field
                                            v-slot="{ field }"
                                            v-model="form.otherNotes"
                                            name="otherNotes"
                                        >
                                            <textarea
                                                v-bind="field"
                                                name="otherNotes"
                                                style="
                                                    display: block;
                                                    width: 100%;
                                                    height: 120px;
                                                "
                                            />
                                        </Field>
                                        <ErrorMessage
                                            name="otherNotes"
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
                                </div>

                            <!-- 登録済みの口座表示 -->
                            <div v-if="!isInputMode">
                                <table class="basic-info">
                                    <tr>
                                        <th>お名前：</th>
                                        <td>
                                            {{ form.lastName }}
                                            {{ form.firstName }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>ふりがな：</th>
                                        <td>
                                            {{ form.lastKana }}
                                            {{ form.firstKana }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>生年月日：</th>
                                        <td>
                                            {{ form.birthday }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>性別：</th>
                                        <td style="white-space: pre-line">
                                            {{ form.sex }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>アレルギー：</th>
                                        <td style="white-space: pre-line">
                                            {{ form.allergy }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>その他特記事項：</th>
                                        <td style="white-space: pre-line">
                                            {{ form.otherNotes }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>お写真：</th>
                                        <td style="white-space: pre-line">
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
                                        </td>
                                    </tr>
                                </table>
                            </div>

                                <div
                                    style="
                                        border: solid 0.5px gray;
                                        margin-top: 1rem;
                                        margin-bottom: 1rem;
                                    "
                                ></div>

                                <div
                                    v-if="
                                        isInputMode &&
                                        Object.keys(errors).length > 0
                                    "
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
                                        v-if="isInputMode && !kidData"
                                        type="button"
                                        class="btn btn-primary"
                                        :disabled="isSubmitting"
                                        @click="addKid"
                                    >
                                        登録
                                    </button>
                                    <button
                                        v-if="!isInputMode && kidData"
                                        type="button"
                                        class="btn btn-primary"
                                        :disabled="isSubmitting"
                                        @click="() => (isInputMode = true)"
                                    >
                                        編集
                                    </button>

                                    <template v-if="isInputMode && kidData">
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            :disabled="isSubmitting"
                                            @click="updateKid"
                                        >
                                            更新
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-danger"
                                            :disabled="isSubmitting"
                                            @click="deleteKid"
                                        >
                                            削除
                                        </button>
                                    </template>
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
    lastName: Validation.Required,
    firstName: Validation.Required,
    lastKana: Validation.Required,
    firstKana: Validation.Required,
    sex: Validation.Required,
    birthday: Validation.Required,
    // allergy: Validation.Required,
    // otherNotes: Validation.Required,
});

useMeta({ title: "お子様情報" });
</script>

<script>
export default {
    data() {
        return {
            isLoaded: false,
            isSubmitting: false,
            errorMessage: "",
            kidData: null,
            isInputMode: true,
            form: {
                id: "",
                lastName: "",
                firstName: "",
                lastKana: "",
                firstKana: "",
                birthday: "",
                sex: "",
                allergy: "",
                otherNotes: "",
            },
            profilePhotoFile: null,
            profileAddress: "",
            sexTypeOptions: [
                { name: "女の子", value: "1", key: "woman" },
                { name: "男の子", value: "2", key: "man" },
                { name: "指定なし", value: "3", key: "other" },
            ],
        };
    },
    async mounted() {
        await this.fetchKid();
        if (this.kidData) {
            this.isInputMode = false;
        }
        this.isLoaded = true;
    },
    methods: {
        async fetchKid() {
            var res = await ApiClient.getKid();
            if (res.isError) {
                this.errorMessage = CommonMessage.Error;
                return;
            }

            var kid = res.data;
            if (kid) {
                this.form = kid;
                this.kidData = kid;
            } else {
                this.kidData = null;
            }
        },
        async updateKid() {
            this.errorMessage = "";
            try {
                const { valid } = await this.$refs.form.validate();
                if (!valid) return;

                this.isSubmitting = true;
                var res = await ApiClient.updateKid(this.form.id, this.form);
                if (res.isError) {
                    this.errorMessage = CommonMessage.Error;
                    // TODO: 後でトーストへ変更
                    errorMessage = CommonMessage.FailedTo("お子様用情報の更新");
                    return;
                }

                

                // プロフィール画像の更新
                if (this.KidPhotoFile) {
                    var res = await ApiClient.updateKidPhoto(
                        this.KidPhotoFile
                    );
                    if (res.isError) {
                        errorMessage =
                            CommonMessage.FailedTo("お子様用写真の更新");
                        return;
                    }
                    this.$refs.KidPhotoFile.value = "";
                    this.KidPhotoFile = null;
                }
                

                await this.fetchKid();
            } finally {
                this.isInputMode = false;
                this.isSubmitting = false;
            }
        },
        onChangeKidPhotoFile(e) {
            if (e.target.files.length === 0) return;
            this.KidPhotoFile = e.target.files[0];
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
.kid-photo {
    height: 200px;
    width: 200px;
    object-fit: contain;
    margin: auto;
    display: block;
}
</style>
