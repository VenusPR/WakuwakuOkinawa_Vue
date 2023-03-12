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
                                <h3 style="padding-bottom: 1rem">お子様情報</h3>
                            </div>
                            <div>
                                シッターサービスをご利用される方はこちらのお子様情報をご入力ください。
                            </div>

                            <!-- 新規作成/編集フォーム -->
                            <Form
                                ref="form"
                                v-slot="{ errors }"
                                :validationSchema="schema"
                            >
                                <div
                                    v-for="(kid, index) in form.kids"
                                    :key="index"
                                >
                                    <div>
                                        <div
                                            class="mt-4"
                                            style="
                                                background-color: #eee;
                                                padding: 0.5rem;
                                                padding-top: 1rem;
                                            "
                                        >
                                            <h5>
                                                お子様 ({{
                                                    this.kidsSubtitles[index]
                                                }})
                                            </h5>
                                        </div>

                                        <div class="mt-1">
                                            <div>
                                                <label
                                                    :for="`kids[${index}].lastName`"
                                                    class="col-form-label"
                                                    >お名前（姓）</label
                                                >
                                                <Field
                                                    v-model="
                                                        form.kids[index]
                                                            .lastName
                                                    "
                                                    :name="`kids[${index}].lastName`"
                                                    type="text"
                                                    class="form-control"
                                                />
                                                <ErrorMessage
                                                    :name="`kids[${index}].lastName`"
                                                    class="error"
                                                />
                                            </div>
                                            <div>
                                                <label
                                                    :for="`kids[${index}].firstName`"
                                                    class="col-form-label"
                                                    >お名前（名）</label
                                                >
                                                <Field
                                                    v-model="
                                                        form.kids[index]
                                                            .firstName
                                                    "
                                                    :name="`kids[${index}].firstName`"
                                                    type="text"
                                                    class="form-control"
                                                />
                                                <ErrorMessage
                                                    :name="`kids[${index}].firstName`"
                                                    class="error"
                                                />
                                            </div>
                                            <div>
                                                <label
                                                    :for="`kids[${index}].lastKana`"
                                                    class="col-form-label"
                                                    >かな（姓）</label
                                                >
                                                <Field
                                                    v-model="
                                                        form.kids[index]
                                                            .lastKana
                                                    "
                                                    :name="`kids[${index}].lastKana`"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder=""
                                                />
                                                <ErrorMessage
                                                    :name="`kids[${index}].lastKana`"
                                                    class="error"
                                                />
                                            </div>
                                            <div>
                                                <label
                                                    :for="`kids[${index}].firstKana`"
                                                    class="col-form-label"
                                                    >かな（名）</label
                                                >
                                                <Field
                                                    v-model="
                                                        form.kids[index]
                                                            .firstKana
                                                    "
                                                    :name="`kids[${index}].firstKana`"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder=""
                                                />
                                                <ErrorMessage
                                                    :name="`kids[${index}].firstKana`"
                                                    class="error"
                                                />
                                            </div>
                                            <div>
                                                <label
                                                    :for="`kids[${index}].birthday`"
                                                    class="col-form-label"
                                                    >生年月日</label
                                                >
                                                <YmdField
                                                    :value="
                                                        form.kids[index]
                                                            .birthday
                                                    "
                                                    :name="`kids[${index}].birthday`"
                                                    @change="
                                                        (value) => {
                                                            onChangeYmd(
                                                                index,
                                                                value
                                                            );
                                                        }
                                                    "
                                                ></YmdField>
                                            </div>
                                            <div>
                                                <label
                                                    :for="`kids[${index}].sex`"
                                                    class="col-form-label"
                                                    >性別</label
                                                >

                                                <Field
                                                    v-slot="{ field }"
                                                    v-model="
                                                        form.kids[index].sex
                                                    "
                                                    :name="`kids[${index}].sex`"
                                                    type="radio"
                                                >
                                                    <div class="input-radio">
                                                        <div
                                                            v-for="option in sexTypeOptions"
                                                            style="
                                                                display: inline;
                                                            "
                                                            :key="option.value"
                                                        >
                                                            <input
                                                                type="radio"
                                                                :name="`kids[${index}].sex`"
                                                                v-bind="field"
                                                                :value="
                                                                    option.value
                                                                "
                                                                :id="
                                                                    option.key +
                                                                    index
                                                                "
                                                                :checked="
                                                                    form.kids[
                                                                        index
                                                                    ].sex ==
                                                                    option.value
                                                                "
                                                            />
                                                            <label
                                                                :for="
                                                                    option.key +
                                                                    index
                                                                "
                                                                class="col-form-label"
                                                                >{{
                                                                    option.name
                                                                }}</label
                                                            >
                                                        </div>
                                                    </div>
                                                </Field>
                                                <ErrorMessage
                                                    :name="`kids[${index}].sex`"
                                                    class="error"
                                                />
                                            </div>
                                            <div>
                                                <label
                                                    :for="`kids[${index}].allergy`"
                                                    class="col-form-label"
                                                    >アレルギー</label
                                                >
                                                <Field
                                                    v-slot="{ field }"
                                                    v-model="
                                                        form.kids[index].allergy
                                                    "
                                                    :name="`kids[${index}].allergy`"
                                                >
                                                    <textarea
                                                        v-bind="field"
                                                        :name="`kids[${index}].allergy`"
                                                        rows="3"
                                                        style="
                                                            display: block;
                                                            width: 100%;
                                                        "
                                                    />
                                                </Field>
                                                <ErrorMessage
                                                    :name="`kids[${index}].allergy`"
                                                    class="error"
                                                />
                                            </div>
                                            <div>
                                                <label
                                                    :for="`kids[${index}].otherNotes`"
                                                    class="col-form-label"
                                                    >その他特記事項</label
                                                >
                                                <Field
                                                    v-slot="{ field }"
                                                    v-model="
                                                        form.kids[index]
                                                            .otherNotes
                                                    "
                                                    :name="`kids[${index}].otherNotes`"
                                                >
                                                    <textarea
                                                        v-bind="field"
                                                        :name="`kids[${index}].otherNotes`"
                                                        rows="3"
                                                        style="
                                                            display: block;
                                                            width: 100%;
                                                        "
                                                    />
                                                </Field>
                                                <ErrorMessage
                                                    :name="`kids[${index}].otherNotes`"
                                                    class="error"
                                                />
                                            </div>
                                            <div style="margin-top: 2rem">
                                                <h5>プロフィール写真</h5>
                                            </div>
                                            <div>
                                                <div
                                                    style="margin-bottom: 1rem"
                                                >
                                                    フォーマット： JPG / JPEG /
                                                    GIF / PNG
                                                </div>

                                                <img
                                                    v-if="
                                                        form.kids[index]
                                                            .photoName
                                                    "
                                                    :src="
                                                        form.kids[index]
                                                            .photoName
                                                    "
                                                    class="kid-photo"
                                                />
                                                <div
                                                    v-else
                                                    class="kid-photo"
                                                    style="
                                                        background-color: gray;
                                                    "
                                                ></div>
                                                <input
                                                    type="file"
                                                    class="form-control"
                                                    style="margin-top: 1rem"
                                                    placeholder=""
                                                    :onchange="
                                                        (e) => {
                                                            onChangeKidsPhotoFiles(
                                                                e,
                                                                index
                                                            );
                                                        }
                                                    "
                                                />
                                            </div>
                                        </div>
                                        <div class="text-center mt-3">
                                            <a
                                                @click="removeKid(index)"
                                                class="text-link"
                                                style="
                                                    font-size: 1rem;
                                                    color: red;
                                                "
                                                ><span class="me-1"
                                                    >{{
                                                        this.kidsSubtitles[
                                                            index
                                                        ]
                                                    }}の削除</span
                                                ><vue-feather
                                                    class="icon icon-16"
                                                    type="x"
                                                ></vue-feather
                                            ></a>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                </div>

                                <div class="text-center m-3">
                                    <a
                                        @click="addKid()"
                                        class="text-link"
                                        :class="{
                                            disabled: isMaxKids,
                                        }"
                                        style="font-size: 1rem"
                                        ><span class="me-1">お子様を追加</span
                                        ><vue-feather
                                            class="icon icon-16"
                                            type="plus"
                                        ></vue-feather
                                    ></a>
                                </div>

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

                                <div class="text-center">
                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        :disabled="isSubmitting"
                                        @click="saveKids"
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
import YmdField from "@/components/YmdField";
import { useMeta } from "@/composables/use-meta";
import { CommonMessage } from "@/messages/common-message";
import { Validation } from "@/utils/validation";
import { ErrorMessage, Field, Form } from "vee-validate";
import * as yup from "yup";

const kidSchema = yup.object().shape({
    lastName: Validation.Required,
    firstName: Validation.Required,
    lastKana: Validation.Required,
    firstKana: Validation.Required,
    sex: Validation.Required,
    birthday: Validation.DateYmd,
});

const schema = yup.object({
    kids: yup.array().of(kidSchema),
});

useMeta({ title: "お子様情報" });
</script>

<script>
export default {
    components: {
        YmdField,
    },
    data() {
        return {
            isLoaded: false,
            isSubmitting: false,
            errorMessage: "",
            kidsData: null,
            isInputMode: true,

            form: {
                kids: [],
                deleteKidIds: [],
            },
            maxKidsNum: 3,
            kidsPhotoFiles: [],

            kidsSubtitles: ["おひとり目", "おふたり目", "さんにん目"],

            profileAddress: "",
            sexTypeOptions: [
                { name: "女の子", value: "1", key: "woman" },
                { name: "男の子", value: "2", key: "man" },
                { name: "指定なし", value: "3", key: "other" },
            ],
        };
    },
    async mounted() {
        await this.fetchKids();

        // もしkidが１つもなければ、１つ追加する
        if (this.form.kids.length == 0) {
            this.addKid();
        }

        this.isLoaded = true;
    },
    computed: {
        isMaxKids() {
            return this.form.kids.length >= this.maxKidsNum;
        },
    },
    methods: {
        async fetchKids() {
            this.form.deleteKidIds = [];

            var res = await ApiClient.getKids();
            if (res.isError) {
                this.errorMessage = CommonMessage.Error;
                return;
            }

            this.form.kids = res.data.kids;
        },

        async addKid() {
            if (this.form.kids.length >= this.maxKidsNum) return;

            this.form.kids.push({
                id: "", // 更新時にはidが入る
                lastName: "",
                firstName: "",
                lastKana: "",
                firstKana: "",
                birthday: "",
                sex: "",
                allergy: "",
                otherNotes: "",
                photoName: null,
            });

            // kidsPhotoFilesのサイズを調整する
            while (this.form.kids.length > this.kidsPhotoFiles.length) {
                this.kidsPhotoFiles.push(null);
            }
        },
        async removeKid(index) {
            if (this.form.kids.length == 0) return;
            var removedKid = this.form.kids.splice(index, 1)[0];
            this.kidsPhotoFiles.splice(index, 1);

            // 削除対象のidがあれば、deleteKidIdsに追加する
            if (removedKid.id != null && removedKid.id != "") {
                this.form.deleteKidIds.push(removedKid.id);
            }
        },
        async saveKids() {
            this.errorMessage = "";
            try {
                const { valid } = await this.$refs.form.validate();
                if (!valid) return;

                this.isSubmitting = true;

                var res = await ApiClient.saveKids(this.form);
                if (res.isError) {
                    // TODO: 後でトーストへ変更
                    this.errorMessage =
                        CommonMessage.FailedTo("お子様用情報の更新");
                    return;
                }

                var kids = res.data.kids;

                // 画像の更新
                for (var i = 0; i < this.kidsPhotoFiles.length; i++) {
                    var kidId = kids[i].id;
                    var kidPhotoFile = this.kidsPhotoFiles[i];
                    if (kidPhotoFile) {
                        var res = await ApiClient.updateKidPhoto(
                            kidId,
                            kidPhotoFile
                        );
                        if (res.isError) {
                            this.errorMessage =
                                CommonMessage.FailedTo("お子様用画像の更新");
                        }
                    }
                }
                this.kidsPhotoFiles = [];

                await this.fetchKids();
            } finally {
                this.isSubmitting = false;
            }
        },

        onChangeKidsPhotoFiles(e, index) {
            if (e.target.files.length === 0) return;
            this.kidsPhotoFiles[index] = e.target.files[0];
        },
        onChangeYmd(index, value) {
            this.form.kids[index].birthday = value.ymd;
        },
    },
};
</script>
<style lang="scss" scoped>
.kid-photo {
    height: 200px;
    width: 200px;
    object-fit: contain;
    margin: auto;
    display: block;
}
</style>
