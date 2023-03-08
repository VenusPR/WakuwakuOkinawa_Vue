<template>
    <div class="layout-px-spacing">
        <div v-if="!isLoaded">まだだよ</div>
        <div v-else class="row layout-spacing">
            <!-- Content -->
            <div class="col-sm-12 layout-top-spacing">
                <div class="user-profile layout-spacing">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="d-flex justify-content-between">
                                <h3 style="padding-bottom: 1rem">
                                    ご高齢者情報
                                </h3>
                            </div>
                            <div>
                                付き添い看護師のご利用される方はこちらのご高齢者情報をご入力ください。
                            </div>
                            <!-- 新規作成／編集フォーム -->
                            <Form
                                ref="form"
                                v-slot="{ errors }"
                                :validationSchema="schema"
                            >
                                <div
                                    v-for="(senior, index) in form.seniors"
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
                                                ご高齢者 ({{
                                                    this.seniorsSubtitles[
                                                        index
                                                    ]
                                                }})
                                            </h5>
                                        </div>
                                        <div class="mt-1">
                                            <div>
                                                <label
                                                    :for="`seniors[${index}].lastName`"
                                                    class="col-form-label"
                                                    >お名前(姓)</label
                                                >
                                                <Field
                                                    v-model="
                                                        form.seniors[index]
                                                            .lastName
                                                    "
                                                    :name="`seniors[${index}].lastName`"
                                                    type="text"
                                                    class="form-control"
                                                />
                                                <ErrorMessage
                                                    :name="`seniors[${index}].lastName`"
                                                    class="error"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label
                                            :for="`seniors[${index}].firstName`"
                                            class="col-form-label"
                                            >お名前(名)</label
                                        >
                                        <Field
                                            v-model="
                                                form.seniors[index].firstName
                                            "
                                            :name="`seniors[${index}].firstName`"
                                            type="text"
                                            class="form-control"
                                        />
                                        <ErrorMessage
                                            :name="`seniors[${index}].firstName`"
                                            class="error"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            :for="`seniors[${index}].lastKana`"
                                            class="col-form-label"
                                            >かな(姓)</label
                                        >
                                        <Field
                                            v-model="
                                                form.seniors[index].lastKana
                                            "
                                            :name="`seniors[${index}].lastKana`"
                                            type="text"
                                            class="form-control"
                                        />
                                        <ErrorMessage
                                            :name="`seniors[${index}].lastKana`"
                                            class="error"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            :for="`seniors[${index}].firstKana`"
                                            class="col-form-label"
                                            >かな(名)</label
                                        >
                                        <Field
                                            v-model="
                                                form.seniors[index].firstKana
                                            "
                                            :name="`seniors[${index}].firstKana`"
                                            type="text"
                                            class="form-control"
                                        />
                                        <ErrorMessage
                                            :name="`seniors[${index}].firstKana`"
                                            class="error"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            :for="`seniors[${index}].birthday`"
                                            class="col-form-label"
                                            >生年月日</label
                                        >
                                        <div>
                                            <Field
                                                v-model="
                                                    form.seniors[index]
                                                        .birthdayYear
                                                "
                                                :name="`seniors[${index}].birthdayYear`"
                                                type="text"
                                                maxlength="4"
                                                class="form-control"
                                                style="
                                                    width: 80px;
                                                    display: inline-block;
                                                    margin-right: 5px;
                                                "
                                            />
                                            <span>年</span>
                                            <Field
                                                v-model="
                                                    form.seniors[index]
                                                        .birthdayMonth
                                                "
                                                :name="`seniors[${index}].birthdayMonth`"
                                                type="text"
                                                maxlength="2"
                                                class="form-control"
                                                style="
                                                    width: 60px;
                                                    display: inline-block;
                                                    margin-right: 10px;
                                                    margin-right: 5px;
                                                "
                                            />
                                            <span>月</span>
                                            <Field
                                                v-model="
                                                    form.seniors[index]
                                                        .birthdayDay
                                                "
                                                :name="`seniors[${index}].birthdayDay`"
                                                type="text"
                                                maxlength="2"
                                                class="form-control"
                                                style="
                                                    width: 60px;
                                                    display: inline-block;
                                                    margin-left: 10px;
                                                    margin-right: 10px;
                                                "
                                                aria-placeholder=""
                                            />
                                            <span>日</span>
                                        </div>
                                        <ErrorMessage
                                            :name="`seniors[${index}].birthdayYear`"
                                            class="error"
                                        />
                                        <ErrorMessage
                                            :name="`seniors[${index}].birthdayMonth`"
                                            class="error"
                                        />
                                        <ErrorMessage
                                            :name="`seniors[${index}].birthdayDay`"
                                            class="error"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            :for="`kids[${index}].sex`"
                                            class="col-form-label"
                                            >性別</label
                                        >
                                        <Field
                                            v-slot="{ field }"
                                            v-model="form.seniors[index].sex"
                                            :name="`seniors[${index}].sex`"
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
                                                        :name="`seniors[${index}].sex`"
                                                        v-bind="field"
                                                        :value="option.value"
                                                        :id="option.key + index"
                                                        :checked="
                                                            form.seniors[index]
                                                                .sex ==
                                                            option.value
                                                        "
                                                    />
                                                    <label
                                                        :for="
                                                            option.key + index
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
                                            :name="`seniors[${index}].sex`"
                                            class="error"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            :for="`seniors[${index}].allergy`"
                                            class="col-form-label"
                                            >アレルギー</label
                                        >
                                        <Field
                                            v-slot="{ field }"
                                            v-model="
                                                form.seniors[index].allergy
                                            "
                                            :name="`seniors[${index}].allergy`"
                                        >
                                            <textarea
                                                v-bind="field"
                                                :name="`seniors[${index}].allergy`"
                                                rows="3"
                                                class="form-control"
                                            />
                                        </Field>
                                        <ErrorMessage
                                            :name="`seniors[${index}].allergy`"
                                            class="error"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            :for="`seniors[${index}].otherNotes`"
                                            class="col-form-label"
                                            >その他特記事項</label
                                        >
                                        <Field
                                            v-slot="{ field }"
                                            v-model="
                                                form.seniors[index].otherNotes
                                            "
                                            :name="`seniors[${index}].otherNotes`"
                                        >
                                            <textarea
                                                v-bind="field"
                                                :name="`seniors[${index}].otherNotes`"
                                                rows="3"
                                                class="form-control"
                                            />
                                        </Field>
                                        <ErrorMessage
                                            :name="`seniors[${index}].otherNotes`"
                                            class="error"
                                        />
                                    </div>
                                    <div style="margin-top: 2rem">
                                        <h5>プロフィール写真</h5>
                                    </div>
                                    <div>
                                        <div style="margin-bottom: 1rem">
                                            フォーマット： JPG / JPEG / GIF /
                                            PNG
                                        </div>
                                        <img
                                            v-if="form.seniors[index].photoName"
                                            :src="form.seniors[index].photoName"
                                            class="senior-photo"
                                        />
                                        <div
                                            v-else
                                            class="senior-photo"
                                            style="background-color: gray"
                                        ></div>
                                        <input
                                            type="file"
                                            class="form-control"
                                            style="margin-top: 1rem"
                                            :onchange="
                                                (e) =>
                                                    onChangeSeniorsPhotoFiles(
                                                        e,
                                                        index
                                                    )
                                            "
                                        />
                                    </div>
                                    <div class="text-center mt-3">
                                        <a
                                            @click="removeSenior(index)"
                                            class="text-link"
                                            style="color: red"
                                        >
                                            <span class="me-1">
                                                {{
                                                    this.seniorsSubtitles[index]
                                                }}
                                                の削除
                                            </span>
                                            <vue-feather
                                                class="icon icon-16"
                                                type="x"
                                            ></vue-feather
                                        ></a>
                                    </div>
                                    <div class="divider"></div>
                                </div>
                                <div class="text-center m-3">
                                    <a
                                        @click="addSenior()"
                                        class="text-link"
                                        :class="{
                                            disabled: isMaxSeniors,
                                        }"
                                        style="font-size: 1rem"
                                    >
                                        <span class="me-1"> もう一人追加 </span>
                                        <vue-feather
                                            class="icon icon-16"
                                            type="plus"
                                        ></vue-feather
                                    ></a>
                                </div>

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
                                <div class="text-center">
                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        :disabled="isSubmitting"
                                        @click="saveSeniors"
                                    >
                                        保存
                                    </button>
                                </div>
                            </Form>
                        </div>
                    </div>
                    <!-- panel-body -->
                </div>
                <!-- panel -->
            </div>
            <!-- user-profile layout-spacing -->
        </div>
        <!-- col-sm-12 layout-top-spacing -->
    </div>
    <!-- End Content -->
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

const SeniorScheme = yup.object().shape({
    lastName: Validation.Required,
    firstName: Validation.Required,
    lastKana: Validation.Required,
    firstKana: Validation.Required,
    sex: Validation.Required,
    birthdayYear: Validation.Required,
    birthdayMonth: Validation.Required,
    birthdayDay: Validation.Required,
});

const schema = yup.object({
    seniors: yup.array().of(SeniorScheme),
});

useMeta({ title: "ご高齢者情報" });
</script>

<script>
export default {
    data() {
        return {
            isLoaded: false,
            isSubmitting: false,
            errorMessage: "",
            form: {
                seniors: [],
                deleteSeniorIds: [],
            },
            maxSeniorsNum: 2,
            seniorsPhotoFiles: [],

            seniorsSubtitles: ["おひとり目", "おふたり目"],
            profileAddress: "",
            sexTypeOptions: [
                { value: "1", name: "女性", key: "woman" },
                { value: "2", name: "男性", key: "man" },
                { value: "3", name: "指定なし", key: "other" },
            ],
        };
    },
    async mounted() {
        await this.fetchSeniors();

        if (this.form.seniors.length == 0) {
            this.addSenior();
        }
        this.isLoaded = true;
    },
    computed: {
        isMaxSeniors() {
            return this.form.seniors.length >= this.maxSeniorsNum;
        },
    },
    methods: {
        async fetchSeniors() {
            this.form.deleteSeniorIds = [];

            var res = await ApiClient.getSeniors();
            if (res.isError) {
                this.errorMessage = CommonMessage.Error;
                return;
            }

            this.form.seniors = res.data.seniors;

            // birthdayを年月日に分割
            for (var i = 0; i < this.form.seniors.length; i++) {
                var senior = this.form.seniors[i];
                var birthdayArray = senior.birthday.split("-");
                senior.birthdayYear = birthdayArray[0];
                senior.birthdayMonth = birthdayArray[1];
                senior.birthdayDay = birthdayArray[2];
            }
        },

        async addSenior() {
            if (this.form.seniors.length >= this.maxSeniorsNum) {
                return;
            }

            this.form.seniors.push({
                id: "",
                lastName: "",
                firstName: "",
                lastKana: "",
                firstKana: "",
                birthdayYear: "",
                birthdayMonth: "",
                birthdayDay: "",
                sex: "",
                allergy: "",
                otherNotes: "",
                tel: "",
                photoName: "",
            });

            // seniorsPhotofilesのサイズを調整する
            while (this.form.seniors.length > this.seniorsPhotoFiles.length) {
                this.seniorsPhotoFiles.push(null);
            }
        },
        async removeSenior(index) {
            if (this.form.seniors.length == 0) {
                return;
            }
            var removedSenior = this.form.seniors.splice(index, 1)[0];
            this.seniorsPhotoFiles.splice(index, 1);

            // 削除対象のidがあれば、deleteSeniorIdsに追加する
            if (removedSenior.id != null && removedSenior.id != "") {
                this.form.deleteSeniorIds.push(removedSenior.id);
            }
        },
        async saveSeniors() {
            this.errorMessage = "";
            try {
                const { valid } = await this.$refs.form.validate();
                if (!valid) {
                    return;
                }

                this.isSubmitting = true;

                for (var i = 0; i < this.form.seniors.length; i++) {
                    var senior = this.form.seniors[i];
                    senior.birthday =
                        senior.birthdayYear +
                        "-" +
                        senior.birthdayMonth.padStart(2, "0") +
                        "-" +
                        senior.birthdayDay.padStart(2, "0");
                }

                var res = await ApiClient.saveSeniors(this.form);
                if (res.isError) {
                    this.errorMessage =
                        CommonMessage.FailedTo("ご高齢者情報の更新");
                    return;
                }

                var seniors = res.data.seniors;

                // 画像をアップロードする
                for (var i = 0; i < this.seniorsPhotoFiles.length; i++) {
                    var seniorId = seniors[i].id;
                    var seniorPhotoFile = this.seniorsPhotoFiles[i];
                    if (seniorPhotoFile) {
                        var res = await ApiClient.updateSeniorPhoto(
                            seniorId,
                            seniorPhotoFile
                        );
                    }

                    if (res.isError) {
                        this.errorMessage =
                            CommonMessage.FailedTo("ご高齢者用画像の更新");
                    }
                }
                this.seniorsPhotoFiles = [];

                await this.fetchSeniors();
            } finally {
                this.isSubmitting = false;
            }
        },

        onChangeSeniorsPhotoFiles(e, index) {
            if (e.target.files.length == 0) return;
            this.seniorsPhotoFiles[index] = e.target.files[0];
        },
    },
};
</script>
<style lang="scss" scoped>
.senior-photo {
    height: 200px;
    width: 200px;
    object-fit: contain;
    margin: auto;
    display: block;
}
</style>
