<template>
    <div class="layout-px-spacing">
        <div class="row layout-spacing">
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
                                <div>
                                    <label for="email" class="col-form-label"
                                        >銀行名</label
                                    >

                                    <Field
                                        name="bankName"
                                        v-model="form.branchName"
                                        type="text"
                                        class="form-control"
                                    />
                                    <ErrorMessage
                                        name="bankName"
                                        class="error"
                                    />
                                </div>
                                <div>
                                    <label for="email" class="col-form-label"
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
                                    <label for="email" class="col-form-label"
                                        >口座種別</label
                                    >
                                    <Field
                                        v-model="form.accountType"
                                        name="accountType"
                                        class="form-select"
                                        as="select"
                                    >
                                        <option value="1">普通</option>
                                        <option value="2">当座</option>
                                        <option value="3">その他</option>
                                    </Field>
                                    <ErrorMessage
                                        name="branchName"
                                        class="error"
                                    />
                                </div>
                                <div>
                                    <label for="email" class="col-form-label"
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
                                    <label for="email" class="col-form-label"
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

                                <!-- 登録済みの口座表示 -->
                                <div v-if="hasBankData">
                                    <ul class="contacts-block list-unstyled">
                                        <li class="contacts-block__item">
                                            <span>銀行名：</span>
                                            <span>沖縄</span>
                                        </li>
                                        <li class="contacts-block__item">
                                            <span>銀行名：</span>
                                            <span>沖縄</span>
                                        </li>
                                        <li class="contacts-block__item">
                                            <span>支店名：</span>
                                            <span>牧港</span>
                                        </li>
                                        <li class="contacts-block__item">
                                            <span>口座種別：</span>
                                            <span>普通</span>
                                        </li>
                                        <li class="contacts-block__item">
                                            <span>口座番号：</span>
                                            <span>1621334</span>
                                        </li>
                                        <li class="contacts-block__item">
                                            <span>口座名義：</span>
                                            <span>ハマダヨウイチ</span>
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
                                        v-if="!hasBankData"
                                        type="button"
                                        class="btn btn-primary"
                                        @click="addBank"
                                    >
                                        追加
                                    </button>
                                    <button
                                        v-if="hasBankData"
                                        type="button"
                                        class="btn btn-primary"
                                        @click="updateBank"
                                    >
                                        更新
                                    </button>
                                    <button
                                        v-if="hasBankData"
                                        type="button"
                                        class="btn btn-danger"
                                        @click="deleteBank"
                                    >
                                        削除
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
import "@/assets/sass/scrollspyNav.scss";
import "@/assets/sass/users/user-profile.scss";
import { useMeta } from "@/composables/use-meta";
import { ErrorMessage, Field, Form } from "vee-validate";
import * as yup from "yup";

const schema = yup.object({
    bankName: yup.string().required(),
    branchName: yup.string().required(),
    bankType: yup.string().required(),
    accountNumber: yup.string().required(),
    accountName: yup.string().required(),
});

useMeta({ title: "受取口座設定" });
</script>
<script>
export default {
    data() {
        return {
            hasBankData: false,
            form: {
                bankName: "",
                branchName: "",
                bankType: "",
                accountNumber: "",
                accountName: "",
            },
        };
    },
    mounted() {
        console.log("mounted!");
    },
    methods: {
        async addBank() {
            const { valid } = await this.$refs.form.validate();
            if (!valid) return;
            console.log("addBank");
        },
        async updateBank() {
            const { valid } = await this.$refs.form.validate();
            if (!valid) return;
            console.log("updateBank");
        },
        async deleteBank() {
            console.log("deleteBank");
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
