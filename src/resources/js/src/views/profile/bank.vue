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
                            <!-- 新規作成フォーム -->
                            <Form ref="form" :validationSchema="schema">
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
                                            required="true"
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
                                            required="true"
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
                                            required="true"
                                        />
                                        <ErrorMessage
                                            name="accountName"
                                            class="error"
                                        />
                                    </div>
                                </div>

                                <!-- 登録済みの口座表示 -->
                                <div v-if="!isInputMode">
                                    <ul class="contacts-block list-unstyled">
                                        <li class="contacts-block__item">
                                            <span>銀行名：</span>
                                            <span>{{ form.bankName }}</span>
                                        </li>
                                        <li class="contacts-block__item">
                                            <span>支店名：</span>
                                            <span>{{ form.branchName }}</span>
                                        </li>
                                        <li class="contacts-block__item">
                                            <span>口座種別：</span>
                                            <span>{{ form.accountType }}</span>
                                        </li>
                                        <li class="contacts-block__item">
                                            <span>口座番号：</span>
                                            <span>{{
                                                form.accountNumber
                                            }}</span>
                                        </li>
                                        <li class="contacts-block__item">
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
                                <div>
                                    <button
                                        v-if="isInputMode && !bankData"
                                        type="button"
                                        class="btn btn-primary"
                                        @click="addBank"
                                    >
                                        追加
                                    </button>
                                    <button
                                        v-if="!isInputMode && bankData"
                                        type="button"
                                        class="btn btn-primary"
                                        @click="() => (isInputMode = true)"
                                    >
                                        編集
                                    </button>

                                    <template v-if="isInputMode && bankData">
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            @click="updateBank"
                                        >
                                            更新
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-danger"
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
import { ValidationMessage } from "@/messages/validation-message";
import { ErrorMessage, Field, Form } from "vee-validate";
import * as yup from "yup";

const schema = yup.object({
    bankName: yup.string().required(ValidationMessage.Required),
    branchName: yup.string().required(ValidationMessage.Required),
    accountType: yup.string().required(ValidationMessage.Required),
    accountNumber: yup.string().required(ValidationMessage.Required),
    accountName: yup.string().required(ValidationMessage.Required),
});

useMeta({ title: "受取口座設定" });
</script>
<script>
export default {
    data() {
        return {
            isLoaded: false,
            bankData: null,
            isInputMode: true,
            form: {
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
        console.log("mounted!");

        await this.fetchBank();
        if (this.bankData) {
            this.isInputMode = false;
        }
        this.isLoaded = true;
    },
    methods: {
        async fetchBank() {
            var bank = await ApiClient.getBank();
            if (bank) {
                console.log("bank", bank);
                this.bankData = bank;
                this.form.bankName = bank.bank_name;
                this.form.branchName = bank.branch_name;
                this.form.accountType = bank.account_type;
                this.form.accountName = bank.account_name;
                this.form.accountNumber = bank.account_number;
            } else {
                this.bankData = null;
                this.form.bankName = "";
                this.form.branchName = "";
                this.form.accountType = "";
                this.form.accountName = "";
                this.form.accountNumber = "";
            }
        },
        async addBank() {
            const { valid } = await this.$refs.form.validate();
            if (!valid) return;

            var res = await ApiClient.addBank({
                bank_name: this.form.bankName,
                branch_name: this.form.branchName,
                account_type: this.form.accountType,
                account_number: this.form.accountNumber,
                account_name: this.form.accountName,
            });
            await this.fetchBank();
            this.isInputMode = false;
        },
        async updateBank() {
            const { valid } = await this.$refs.form.validate();
            if (!valid) return;
            console.log("updateBank");

            var res = await ApiClient.updateBank(this.bankData.id, {
                bank_name: this.form.bankName,
                branch_name: this.form.branchName,
                account_type: this.form.accountType,
                account_number: this.form.accountNumber,
                account_name: this.form.accountName,
            });
            await this.fetchBank();
            this.isInputMode = false;
        },
        async deleteBank() {
            console.log("deleteBank");
            var res = await ApiClient.deleteBank(this.bankData.id);
            await this.fetchBank();
            this.isInputMode = true;
        },
    },
};
</script>
<style scoped>
.btn {
    margin-left: 0.5rem;
    margin-right: 0.5rem;
}
.error {
    color: red;
}
</style>
