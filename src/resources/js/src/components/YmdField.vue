<template>
    <div>
        <Field
            v-model="form.year"
            class="form-select"
            as="select"
            @change="onChange"
            style="
                width: 80px;
                min-width: 80px;
                display: inline-block;
                padding-left: 10px;
            "
            :name="`${name}-year`"
        >
            <option
                v-for="opt in yearOptions"
                v-bind:value="opt.value"
                :selected="opt.value == form.year"
                :key="'year-' + opt.value"
            >
                {{ opt.value }}
            </option>
        </Field>
        <span class="p-1 pe-2">年</span>
        <Field
            v-model="form.month"
            class="form-select"
            as="select"
            @change="onChange"
            style="
                width: 65px;
                min-width: 65px;
                display: inline-block;
                padding-left: 10px;
            "
            :name="`${name}-month`"
        >
            <option
                v-for="opt in monthOptions"
                v-bind:value="opt.value"
                :selected="opt.value == form.month"
                :key="'month-' + opt.value"
            >
                {{ opt.value }}
            </option>
        </Field>
        <span class="p-1 pe-2">月</span>
        <Field
            v-model="form.day"
            class="form-select"
            as="select"
            style="
                width: 65px;
                min-width: 65px;
                display: inline-block;
                padding-left: 10px;
            "
            @change="onChange"
            :name="`${name}-day`"
        >
            <option
                v-for="opt in dayOptions"
                v-bind:value="opt.value"
                :selected="opt.value == form.day"
                :key="'day-' + opt.value"
            >
                {{ opt.value }}
            </option>
        </Field>
        <span class="p-1">日</span>
        <Field
            :name="name"
            type="hidden"
            v-model="form.ymd"
            :value="form.ymd"
        />
    </div>
    <ErrorMessage :name="name" class="error" style="display: block" />
</template>

<script setup>
import "@/assets/sass/scrollspyNav.scss";
import "@/assets/sass/users/user-profile.scss";
import { ErrorMessage, Field } from "vee-validate";
</script>

<script>
export default {
    props: {
        name: {
            type: String,
            default: "yearMonthDay",
        },
        value: {
            type: String,
            default: "",
        },
    },
    emits: ["change"],
    data() {
        return {
            isLoaded: false,
            form: {
                ymd: "",
                year: "",
                month: "",
                day: "",
            },
            yearOptions: [],
            monthOptions: [],
            dayOptions: [],
        };
    },
    async mounted() {
        this.form.ymd = this.value;
        if (this.value) {
            this.value.split("-").forEach((v, i) => {
                if (i == 0) {
                    this.form.year = v;
                } else if (i == 1) {
                    this.form.month = v.padStart(2, "0");
                } else if (i == 2) {
                    this.form.day = v.padStart(2, "0");
                }
            });
        }

        if (this.yearOptions.length == 0) {
            // 年
            var fromYear = new Date().getFullYear();
            for (var i = fromYear - 100; i <= fromYear; i++) {
                this.yearOptions.push({ value: i });
            }
            // 月
            for (var i = 1; i <= 12; i++) {
                var value = ("" + i).padStart(2, "0");
                this.monthOptions.push({ value: value });
            }
            // 日
            for (var i = 1; i <= 31; i++) {
                var value = ("" + i).padStart(2, "0");
                this.dayOptions.push({ value: value });
            }
        }

        this.isLoaded = true;
    },

    methods: {
        async onChange(e) {
            this.errorMessage = "";
            if (
                this.form.year == "" ||
                this.form.month == "" ||
                this.form.day == ""
            ) {
                return;
            }

            var year = this.form.year;
            var month = this.form.month;
            var day = this.form.day;

            this.form.ymd = year + "-" + month + "-" + day;

            this.$emit("change", {
                ymd: this.form.ymd,
                year: this.form.year,
                month: this.form.month,
                day: this.form.day,
            });
        },
    },
};
</script>
<style lang="scss" scoped></style>
