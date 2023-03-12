import * as yup from "yup";

export const ValidationMessage = {
    Required: "必須項目です。"
}

export const ValidationMethod = {
    // 年月日の日付チェック 例) "2020-01-01"
    isDateYmd: (value) => {
        if (!value) {
            return true
        }

        var day = 0;
        var splitValues = value.split("-")
        if (splitValues.length > 2) {
            day = splitValues[2];
        }

        var date = new Date(value);
        if (!date.getDate() || date.getDate() != day) {
            return false
        }
        return true
    }
}

export const Validation = {
    Required: yup.string()
        .required(ValidationMessage.Required),

    DateYmd: yup.string()
        .required(ValidationMessage.Required)
        .test('isDateYmd', "正しい日付を入力してください。", ValidationMethod.isDateYmd)
}

