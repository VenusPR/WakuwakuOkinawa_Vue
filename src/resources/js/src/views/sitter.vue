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
                                    シッター設定
                                </h3>
                            </div>
                            <div>
                                <!-- 付き添い看護師のご利用される方はこちらのご高齢者情報をご入力ください。 -->
                            </div>
                            <Form
                                ref="form"
                                v-slot="{ errors }"
                                :validationSchema="schema"
                            >
                                <div>
                                    <div v-for="i in 5" :key="i">
                                        <h4>写真{{ i }}</h4>
                                        <img
                                            v-if="form.sitter['photo' + i]"
                                            :src="form.sitter['photo' + i]"
                                            class="sitter-photo"
                                        />
                                        <div
                                            v-else
                                            class="sitter-photo"
                                            style="background-color: gray"
                                        ></div>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <a class="text-link" href="/sitter/photo">
                                        <span class="me-1">
                                            写真を編集する
                                        </span>
                                        <vue-feather
                                            class="icon icon-16"
                                            type="chevron-right"
                                        ></vue-feather
                                    ></a>
                                </div>
                                <div>
                                    <label
                                        for="title"
                                        class="col-form-label fw-bold"
                                        >シッターサービスのタイトル</label
                                    >
                                    <Field
                                        v-slot="{ field }"
                                        v-model="form.sitter.title"
                                        name="title"
                                    >
                                        <textarea
                                            v-bind="field"
                                            name="title"
                                            rows="3"
                                            class="form-control"
                                        />
                                    </Field>
                                    <ErrorMessage name="title" class="error" />
                                </div>
                                <div>
                                    <label
                                        for="contents"
                                        class="col-form-label fw-bold"
                                        >シッターサービスの紹介文</label
                                    >
                                    <Field
                                        v-slot="{ field }"
                                        v-model="form.sitter.contents"
                                        name="contents"
                                    >
                                        <textarea
                                            v-bind="field"
                                            name="contents"
                                            rows="3"
                                            class="form-control"
                                        />
                                    </Field>
                                    <ErrorMessage
                                        name="contents"
                                        class="error"
                                    />
                                </div>
                                <div>
                                    <label
                                        for="notes"
                                        class="col-form-label fw-bold"
                                        >注意事項・受け入れ条件</label
                                    >
                                    <Field
                                        v-slot="{ field }"
                                        v-model="form.sitter.notes"
                                        name="notes"
                                    >
                                        <textarea
                                            v-bind="field"
                                            name="notes"
                                            rows="3"
                                            class="form-control"
                                        />
                                    </Field>
                                    <ErrorMessage name="notes" class="error" />
                                </div>
                                <div>
                                    <label
                                        for="experience"
                                        class="col-form-label fw-bold"
                                        >ご自身の資格や経験</label
                                    >
                                    <Field
                                        v-slot="{ field }"
                                        v-model="form.sitter.experience"
                                        name="experience"
                                    >
                                        <textarea
                                            v-bind="field"
                                            name="experience"
                                            rows="3"
                                            class="form-control"
                                        />
                                    </Field>
                                    <ErrorMessage
                                        name="experience"
                                        class="error"
                                    />
                                </div>
                                <div>
                                    <label
                                        for="fee"
                                        class="col-form-label fw-bold"
                                        >シッターの料金（時給）</label
                                    >
                                    <Field
                                        v-model="form.sitter.fee"
                                        name="fee"
                                        type="text"
                                        class="form-control"
                                    />
                                    <ErrorMessage name="fee" class="error" />
                                </div>
                                <div>
                                    <label for="plusFee" class="col-form-label"
                                        >二人以上の追加料金（時給）</label
                                    >
                                    <Field
                                        v-model="form.sitter.plusFee"
                                        name="plusFee"
                                        type="text"
                                        class="form-control"
                                    />
                                    <ErrorMessage
                                        name="plusFee"
                                        class="error"
                                    />
                                </div>

                                <div>
                                    <label
                                        for="acceptable_number"
                                        class="col-form-label fw-bold"
                                        >受け入れ可能人数</label
                                    >
                                    「原則はお一人ですが、兄弟なら３人まで」と表示されます
                                    <Field
                                        v-model="form.sitter.acceptable_number"
                                        name="acceptable_number"
                                        class="form-control"
                                    />
                                    <select class="form-select">
                                        <option
                                            value="1"
                                            :selected="
                                                form.sitter
                                                    .acceptable_number === '1'
                                            "
                                        >
                                            1人
                                        </option>
                                        <option
                                            value="2"
                                            :selected="
                                                form.sitter
                                                    .acceptable_number === '2'
                                            "
                                        >
                                            2人
                                        </option>
                                        <option
                                            value="3"
                                            :selected="
                                                form.sitter
                                                    .acceptable_number === '3'
                                            "
                                        >
                                            3人
                                        </option>
                                    </select>
                                    <ErrorMessage
                                        name="acceptable_number"
                                        class="error"
                                    />
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
                        <!-- panel-body -->
                    </div>
                    <!-- panel -->
                </div>
                <!-- user-profile layout-spacing -->
            </div>
            <!-- col-sm-12 layout-top-spacing -->
        </div>
        <!-- End Content -->
    </div>
    <!-- End ayout-px-spacing -->
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
    title: Validation.Required,
    contents: Validation.Required,
    fee: Validation.Required,
    acceptable_number: Validation.Required,
    childcare_min: Validation.Required,
    childcare_max: Validation.Required,
    min_support_hour: Validation.Required,
});
useMeta({ title: "シッター設定" });
</script>

<script>
export default {
    data() {
        return {
            isLoaded: false,
            isSubmitting: false,
            errorMessage: "",
            form: {
                sitter: {
                    title: "",
                    contents: "",
                    fee: "",
                    acceptable_number: "",
                    childcare_min: "",
                    childcare_max: "",
                    min_support_hour: "",
                },
            },
            profileAddress: "",
        };
    },
    async mounted() {
        await this.fetchSitter();

        // if (this.form.seniors.length == 0) {
        //     this.addSenior();
        // }
        this.isLoaded = true;
    },

    methods: {
        async fetchSitter() {
            var res = await ApiClient.getSitter();
            if (res.isError) {
                this.errorMessage = CommonMessage.Error;
                return;
            }

            this.form.sitter = res.data.sitter;
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

                await this.fetchSitter();
            } finally {
                this.isSubmitting = false;
            }
        },
    },
};
</script>
<style lang="scss" scoped>
.sitter-photo {
    height: 200px;
    width: 200px;
    object-fit: contain;
    margin: auto;
    display: block;
}
</style>
