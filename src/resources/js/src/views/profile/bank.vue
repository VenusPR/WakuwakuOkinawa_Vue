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
                                    受取口座設定
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
                                <h5>売上の受取口座</h5>
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
                                            >銀行名</label
                                        >

                                        <Field
                                            name="bankName"
                                            v-model="form.bankName"
                                            type="text"
                                            class="form-control"
                                        />
                                        <ErrorMessage
                                            name="bankName"
                                            class="error"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="email"
                                            class="col-form-label"
                                            >支店名</label
                                        >
                                        <Field
                                            v-model="form.branchName"
                                            name="branchName"
                                            type="text"
                                            class="form-control"
                                            placeholder=""
                                        />
                                        <ErrorMessage
                                            name="branchName"
                                            class="error"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="email"
                                            class="col-form-label"
                                            >口座種別</label
                                        >
                                        <Field
                                            v-model="form.accountType"
                                            name="accountType"
                                            class="form-select"
                                            as="select"
                                        >
                                            <option
                                                v-for="option in accountTypeOptions"
                                                v-bind:value="option.value"
                                                :selected="
                                                    option == form.accountType
                                                "
                                                :key="option.value"
                                            >
                                                {{ option.value }}
                                            </option>
                                        </Field>
                                        <ErrorMessage
                                            name="accountType"
                                            class="error"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="email"
                                            class="col-form-label"
                                            >口座番号</label
                                        >
                                        <Field
                                            v-model="form.accountNumber"
                                            name="accountNumber"
                                            type="text"
                                            class="form-control"
                                            placeholder=""
                                        />
                                        <ErrorMessage
                                            name="accountNumber"
                                            class="error"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="email"
                                            class="col-form-label"
                                            >口座名義（カナ）</label
                                        >
                                        <Field
                                            v-model="form.accountName"
                                            name="accountName"
                                            type="text"
                                            class="form-control"
                                            placeholder=""
                                        />
                                        <ErrorMessage
                                            name="accountName"
                                            class="error"
                                        />
                                    </div>
                                </div>

                                <!-- 登録済みの口座表示 -->
                                <div v-if="!isInputMode">
                                    <ul
                                        class="list-unstyled"
                                        style="margin-top: 1rem"
                                    >
                                        <li>
                                            <span>銀行名：</span>
                                            <span>{{ form.bankName }}</span>
                                        </li>
                                        <li>
                                            <span>支店名：</span>
                                            <span>{{ form.branchName }}</span>
                                        </li>
                                        <li>
                                            <span>口座種別：</span>
                                            <span>{{ form.accountType }}</span>
                                        </li>
                                        <li>
                                            <span>口座番号：</span>
                                            <span>{{
                                                form.accountNumber
                                            }}</span>
                                        </li>
                                        <li>
                                            <span>口座名義：</span>
                                            <span>{{ form.accountName }}</span>
                                        </li>
                                    </ul>
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
                                        v-if="isInputMode && !bankData"
                                        type="button"
                                        class="btn btn-primary"
                                        :disabled="isSubmitting"
                                        @click="addBank"
                                    >
                                        登録
                                    </button>
                                    <button
                                        v-if="!isInputMode && bankData"
                                        type="button"
                                        class="btn btn-primary"
                                        :disabled="isSubmitting"
                                        @click="() => (isInputMode = true)"
                                    >
                                        編集
                                    </button>

                                    <template v-if="isInputMode && bankData">
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            :disabled="isSubmitting"
                                            @click="updateBank"
                                        >
                                            更新
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-danger"
                                            :disabled="isSubmitting"
                                            @click="deleteBank"
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
import { Validation } from "@/utils/validation";
import { ErrorMessage, Field, Form } from "vee-validate";
import * as yup from "yup";

const schema = yup.object({
    bankName: Validation.Required,
    branchName: Validation.Required,
    accountType: Validation.Required,
    accountNumber: Validation.Required,
    accountName: Validation.Required,
});

useMeta({ title: "受取口座設定" });
</script>

<script>
export default {
    data() {
        return {
            isLoaded: false,
            isSubmitting: false,
            errorMessage: "",
            bankData: null,
            isInputMode: true,
            form: {
                id: "",
                bankName: "",
                branchName: "",
                bankType: "",
                accountNumber: "",
                accountName: "",
            },
            accountTypeOptions: [
                { value: "普通" },
                { value: "当座" },
                { value: "その他" },
            ],
        };
    },
    async mounted() {
        await this.fetchBank();
        if (this.bankData) {
            this.isInputMode = false;
        }
        this.isLoaded = true;
    },
    methods: {
        async fetchBank() {
            var res = await ApiClient.getBank();
            if (res.isError) {
                this.errorMessage = CommonMessage.Error;
                return;
            }
            var bank = res.data;
            if (bank) {
                this.form = bank;
                this.bankData = bank;
            } else {
                this.bankData = null;
            }
        },
        async addBank() {
            const { valid } = await this.$refs.form.validate();
            if (!valid) return;
            try {
                this.isSubmitting = true;
                var res = await ApiClient.addBank({
                    bank_name: this.form.bankName,
                    branch_name: this.form.branchName,
                    account_type: this.form.accountType,
                    account_number: this.form.accountNumber,
                    account_name: this.form.accountName,
                });
                if (res.isError) {
                    this.errorMessage = CommonMessage.Error;
                    return;
                }
                await this.fetchBank();
            } finally {
                this.isInputMode = false;
                this.isSubmitting = false;
            }
        },
        async updateBank() {
            const { valid } = await this.$refs.form.validate();
            if (!valid) return;

            try {
                this.isSubmitting = true;
                var res = await ApiClient.updateBank(this.form.id, this.form);
                if (res.isError) {
                    this.errorMessage = CommonMessage.Error;
                    return;
                }
                await this.fetchBank();
            } finally {
                this.isInputMode = false;
                this.isSubmitting = false;
            }
        },
        async deleteBank() {
            try {
                this.isSubmitting = true;
                var res = await ApiClient.deleteBank(this.bankData.id);
                if (res.isError) {
                    this.errorMessage = CommonMessage.Error;
                    return;
                }
                await this.fetchBank();
            } finally {
                this.isInputMode = true;
                this.isSubmitting = false;
            }
        },
    },
};
</script>
<style lang="scss" scoped></style>
