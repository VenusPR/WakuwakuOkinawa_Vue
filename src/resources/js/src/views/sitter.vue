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
                                <!-- 受け入れ可能人数 -->
                                <div>
                                    <label
                                        for="acceptableNumber"
                                        class="col-form-label fw-bold"
                                        >受け入れ可能人数</label
                                    >
                                    <p>
                                        「原則はお一人ですが、兄弟なら３人まで」と表示されます
                                    </p>
                                    <Field
                                        v-model="form.sitter.acceptableNumber"
                                        name="acceptableNumber"
                                        class="form-select"
                                        as="select"
                                    >
                                        <option
                                            value="1"
                                            :selected="
                                                form.sitter.acceptableNumber ===
                                                '1'
                                            "
                                        >
                                            1人
                                        </option>
                                        <option
                                            value="2"
                                            :selected="
                                                form.sitter.acceptableNumber ===
                                                '2'
                                            "
                                        >
                                            2人
                                        </option>
                                        <option
                                            value="3"
                                            :selected="
                                                form.sitter.acceptableNumber ===
                                                '3'
                                            "
                                        >
                                            3人
                                        </option>
                                    </Field>
                                    <ErrorMessage
                                        name="acceptableNumber"
                                        class="error"
                                    />
                                </div>
                                <!-- 受け入れ可能年齢 -->
                                <div>
                                    <label
                                        for="childcareMinYaer"
                                        class="col-form-label fw-bold"
                                        >受け入れ可能年齢</label
                                    >
                                    <div class="clearfix"></div>
                                    <Field
                                        v-model="form.sitter.childcareMinYear"
                                        name="childcareMinYear"
                                        class="form-select"
                                        as="select"
                                        style="
                                            width: 100px;
                                            min-width: 80px;
                                            display: inline-block;
                                            padding-left: 10px;
                                        "
                                    >
                                        <option
                                            v-for="opt in CareYearOptions"
                                            v-bind:value="opt.value"
                                            :selected="
                                                opt.value ==
                                                form.sitter.childcareMinYear
                                            "
                                            :key="'year-' + opt.value"
                                        >
                                            {{ opt.value }}
                                        </option>
                                    </Field>
                                    <ErrorMessage
                                        name="childcareMinYear"
                                        class="error"
                                    />
                                    <span class="p-1 pe-2">年</span>
                                    <Field
                                        v-model="form.sitter.childcareMinMonth"
                                        name="childcareMinMonth"
                                        class="form-select"
                                        as="select"
                                        style="
                                            width: 100px;
                                            min-width: 80px;
                                            display: inline-block;
                                            padding-left: 10px;
                                        "
                                    >
                                        <option
                                            v-for="opt in CareMonthOptions"
                                            v-bind:value="opt.value"
                                            :selected="
                                                opt.value ==
                                                form.sitter.childcareMinMonth
                                            "
                                            :key="'month-' + opt.value"
                                        >
                                            {{ opt.value }}
                                        </option>
                                    </Field>
                                    <ErrorMessage
                                        name="childcareMinMonth"
                                        class="error"
                                    />
                                    <span class="p-1 pe-2">ヶ月 から</span>

                                    <Field
                                        v-model="form.sitter.childcareMaxYear"
                                        name="childcareMaxYear"
                                        class="form-select"
                                        as="select"
                                        style="
                                            width: 100px;
                                            min-width: 80px;
                                            display: inline-block;
                                            padding-left: 10px;
                                        "
                                    >
                                        <option
                                            v-for="opt in CareYearOptions"
                                            v-bind:value="opt.value"
                                            :selected="
                                                opt.value ==
                                                form.sitter.childcareMaxYear
                                            "
                                            :key="'year-' + opt.value"
                                        >
                                            {{ opt.value }}
                                        </option>
                                    </Field>
                                    <ErrorMessage
                                        name="childcareMaxYear"
                                        class="error"
                                    />
                                    <span class="p-1 pe-2">年</span>
                                    <Field
                                        v-model="form.sitter.childcareMaxMonth"
                                        name="childcareMaxMonth"
                                        class="form-select"
                                        as="select"
                                        style="
                                            width: 100px;
                                            min-width: 80px;
                                            display: inline-block;
                                            padding-left: 10px;
                                        "
                                    >
                                        <option
                                            v-for="opt in CareMonthOptions"
                                            v-bind:value="opt.value"
                                            :selected="
                                                opt.value ==
                                                form.sitter.childcareMaxMonth
                                            "
                                            :key="'month-' + opt.value"
                                        >
                                            {{ opt.value }}
                                        </option>
                                    </Field>
                                    <ErrorMessage
                                        name="childcareMaxMonth"
                                        class="error"
                                    />
                                    <span class="p-1 pe-2">ヶ月</span>
                                </div>
                                <!-- 最低サポート時間目安 -->
                                <div>
                                    <label
                                        for="minSupportHour"
                                        class="col-form-label fw-bold"
                                        >最低サポート時間目安</label
                                    >
                                    <Field
                                        v-model="form.sitter.minSupportHour"
                                        name="minSupportHour"
                                        class="form-select"
                                        as="select"
                                    >
                                        <option
                                            v-for="opt in minSupportHourOptions"
                                            v-bind:value="opt.value"
                                            :selected="
                                                opt.value ==
                                                form.sitter.minSupportHour
                                            "
                                            :key="'support-' + opt.value"
                                        >
                                            {{ opt.value }}
                                        </option>
                                    </Field>
                                    <ErrorMessage
                                        name="minSupportHour"
                                        class="error"
                                    />
                                </div>

                                <div>
                                    <h4
                                        class="mt-3"
                                        style="padding-bottom: 1rem"
                                    >
                                        オプション
                                    </h4>
                                    <div
                                        v-for="(option, index) in form.sitter
                                            .sitterOption"
                                        :key="index"
                                    >
                                        <h5>オプション{{ index + 1 }}</h5>
                                        <table>
                                            <tr>
                                                <th>オプション内容：</th>
                                                <td>
                                                    {{ option.title }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>料金（予約1回あたり）：</th>
                                                <td>{{ option.fee }}円</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="text-center mt-3">
                                    <a
                                        class="text-link"
                                        href="/sitter/sitter-option"
                                    >
                                        <span class="me-1">
                                            オプションを編集する
                                        </span>
                                        <vue-feather
                                            class="icon icon-16"
                                            type="chevron-right"
                                        ></vue-feather
                                    ></a>
                                </div>

                                <div>
                                    <label
                                        :for="`place.name`"
                                        class="col-form-label fw-bold"
                                        >サポート可能地域</label
                                    >
                                    <div
                                        v-for="(
                                            dbPlace, index
                                        ) in placesCheckbox"
                                        :key="index"
                                    >
                                        <Field
                                            v-model="form.sitter.place"
                                            :name="dbPlace.name"
                                            type="checkbox"
                                            class="form-check-input"
                                        >
                                            <label>
                                                <input
                                                    type="checkbox"
                                                    :name="dbPlace.name"
                                                    :value="dbPlace.id"
                                                    :checked="
                                                        computedPlaces.includes(
                                                            dbPlace.id
                                                        )
                                                    "
                                                />
                                                {{ dbPlace.name }}
                                            </label>
                                        </Field>
                                    </div>
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
                                        @click="saveSitter"
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
    acceptableNumber: Validation.Required,
    childcareMinYear: Validation.Required,
    childcareMinMonth: Validation.Required,
    childcareMaxYear: Validation.Required,
    childcareMaxMonth: Validation.Required,
    minSupportHour: Validation.Required,
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
                    acceptableNumber: "",
                    childcareMinYear: "",
                    childcareMinMonth: "",
                    childcareMaxYear: "",
                    childcareMaxMonth: "",
                    minSupportHour: "",
                },
            },
            CareYearOptions: [],
            CareMonthOptions: [],
            minSupportHourOptions: [],
            placesCheckbox: [],
        };
    },
    async mounted() {
        await this.fetchSitter();
        await this.getPlaces();

        // if (this.form.seniors.length == 0) {
        //     this.addSenior();
        // }

        // 歳（年）
        for (var i = 0; i <= 15; i++) {
            var value = "" + i;
            this.CareYearOptions.push({ value: value });
        }
        // 歳（月）
        for (var i = 0; i <= 11; i++) {
            var value = "" + i;
            this.CareMonthOptions.push({ value: value });
        }
        // 最低サポート時間
        for (var i = 1; i <= 10; i++) {
            var value = "" + i;
            this.minSupportHourOptions.push({ value: value });
        }
        this.isLoaded = true;
    },

    methods: {
        async getPlaces() {
            var res = await ApiClient.getPlaces();
            if (res.isError) {
                this.errorMessage = CommonMessage.Error;
                return;
            }

            this.placesCheckbox = res.data.place;
        },
        async fetchSitter() {
            var res = await ApiClient.getSitter();
            if (res.isError) {
                this.errorMessage = CommonMessage.Error;
                return;
            }

            this.form.sitter = res.data.sitter;
        },

        async saveSitter() {
            this.errorMessage = "";
            try {
                const { valid } = await this.$refs.form.validate();
                if (!valid) {
                    return;
                }

                this.isSubmitting = true;

                var res = await ApiClient.updateSitter(this.form);
                if (res.isError) {
                    this.errorMessage =
                        CommonMessage.FailedTo("シッター情報の更新");
                    return;
                }

                await this.fetchSitter();
            } finally {
                this.isSubmitting = false;
            }
        },
    },

    computed: {
        computedPlaces() {
            const selectedPlaces = this.form.sitter.place.map(
                (place) => place.id
            );
            return JSON.stringify(selectedPlaces);
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
