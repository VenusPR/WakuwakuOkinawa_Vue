import * as yup from "yup";

export const ValidationMessage = {
    Required: "必須項目です。"
}

export const Validation = {
    Required: yup.string().required(ValidationMessage.Required)
}
