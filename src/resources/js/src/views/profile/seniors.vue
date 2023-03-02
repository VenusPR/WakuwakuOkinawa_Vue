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
                            <div
                                style="
                                    border: solid 0.5px gray;
                                    margin-top: 1rem;
                                    margin-bottom: 1rem;
                                "
                            ></div>
                            <div
                                v-for="(senior, index) in form.seniors"
                                :key="senior"
                            >
                                <div v-if="index == 0">
                                    <h5>ご高齢者(おひとり目)</h5>
                                </div>
                                <div v-if="index == 1">
                                    <h5>ご高齢者(おふたり目)</h5>
                                </div>
                                <!-- 新規作成/編集フォーム -->
                                <Form
                                    ref="form"
                                    v-slot="{ errors }"
                                    :validationSchema="schemas[index]"
                                >
                                    <div v-if="isInputMode[index]">
                                        <div>
                                            <label
                                                for="lastName"
                                                class="col-sm-2 col-form-label"
                                                >お名前</label
                                            >
                                            <Field
                                                name="lastName"
                                                v-model="senior.lastName"
                                                type="text"
                                                class="form-control"
                                                placeholder="姓"
                                            />
                                            <ErrorMessage
                                                name="lastName"
                                                class="error"
                                            />
                                        </div>
                                    </div>
                                    <!-- 登録済みの高齢者情報 -->
                                    <div v-if="!isInputMode[index]">
                                        <table>
                                            <tr>
                                                <td>お名前</td>
                                                <td>
                                                    {{ senior.lastName }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div>
                                        <button
                                            v-if="
                                                !isInputMode[index] &&
                                                seniorsData
                                            "
                                            type="button"
                                            class="btn btn-primary"
                                            :disabled="isSubmitting[index]"
                                            @click="
                                                () =>
                                                    (isInputMode[index] = true)
                                            "
                                        >
                                            編集
                                        </button>
                                        <template
                                            v-if="
                                                isInputMode[index] &&
                                                seniorsData
                                            "
                                        >
                                            <button
                                                type="button"
                                                class="btn btn-primary"
                                                :disabled="isSubmitting[index]"
                                                @click="
                                                    multiUpdateSenior(index)
                                                "
                                            >
                                                更新
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-danger"
                                                :disabled="isSubmitting[index]"
                                                @click="deleteBank"
                                            >
                                                削除
                                            </button>
                                        </template>
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
    </div>
</template>

<script setup>
import ApiClient from "@/api/api-client";
import "@/assets/sass/scrollspyNav.scss";
import "@/assets/sass/users/user-profile.scss";
import { useMeta } from "@/composables/use-meta";
import { Validation } from "@/utils/validation";
import { ErrorMessage, Field, Form } from "vee-validate";
import * as yup from "yup";

// const schema = yup.osbject({
//     lastName: Validation.Required,
//     firstName: Validation.Required,
//     lastKana: Validation.Required,
//     firstKana: Validation.Required,
//     sex: Validation.Required,
//     birthday: Validation.Required,
// });
const schemas = [
    yup.object({
        lastName: Validation.Required,
        firstName: Validation.Required,
        lastKana: Validation.Required,
        firstKana: Validation.Required,
        sex: Validation.Required,
        birthday: Validation.Required,
    }),
    yup.object({
        lastName: Validation.Required,
        firstName: Validation.Required,
        lastKana: Validation.Required,
        firstKana: Validation.Required,
        sex: Validation.Required,
        birthday: Validation.Required,
    }),
];
useMeta({ title: "ご高齢者情報" });
</script>

<script>
export default {
    data() {
        return {
            isLoaded: false,
            isSubmitting: [],
            // isInputMode0: frue,
            isInputMode: [],
            seniorsData: null,
            form: {
                seniors: [
                    {
                        id: "",
                        lastName: "",
                        firstName: "",
                        lastKana: "",
                        firstKana: "",
                        birthday: "",
                        sex: "",
                        allergy: "",
                        otherNotes: "",
                        tel: "",
                    },
                    {
                        id: "",
                        lastName: "",
                        firstName: "",
                        lastKana: "",
                        firstKana: "",
                        birthday: "",
                        sex: "",
                        allergy: "",
                        otherNotes: "",
                        tel: "",
                    },
                ],
            },
        };
    },
    async mounted() {
        await this.fetchSeniors();
        for (var i = 0; i < 1; i++) {
            this.isInputMode[i] = true;
        }
        if (this.seniorsData) {
            for (var i = 0; i < 1; i++) {
                this.isInputMode[i] = false;
            }
        }
        this.isLoaded = true;
    },
    methods: {
        async fetchSeniors() {
            var res = await ApiClient.getSeniors();
            if (res.isError) {
                this.errorMessage = CommonMessage.Error;
                return;
            }
            var seniors = res.data;
            if (seniors) {
                this.form.seniors = seniors;
                this.seniorsData = seniors;
            } else {
                this.seniorsData = null;
            }
        },
        async updateSenior(index) {
            // console.log("koko");
            const { valid } = await this.$refs.form.seniors[index].validate();
            if (!valid) return;
            try {
                this.isSubmitting[index] = true;
                var res = await ApiClient.updateSenior(
                    this.form.seniors[index]
                );
                if (res.isError) {
                    this.errorMessage = CommonMessage.Error;
                    return;
                }
                await this.fetchSeniors();
            } finally {
                this.isSubmitting[index] = false;
                this.isInputMode[index] = false;
            }
        },
        async multiUpdateSenior(index) {
            const { valid } = await this.$refs.form[index].validate();
            if (!valid) return;
            try {
                this.isSubmitting[index] = true;
                var res = await ApiClient.multiUpdateSeniors(this.form);
                if (res.isError) {
                    this.errorMessage = CommonMessage.Error;
                    return;
                }
                await this.fetchSeniors();
            } finally {
                this.isSubmitting[index] = false;
                this.isInputMode[index] = false;
            }
        },
    },
    components: { ErrorMessage },
};
</script>
