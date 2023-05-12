import { ElNotification } from "element-plus";
import { t } from "ttag";
import EventUtil from "util/event_util";
import RequestUtil from "util/request_util";

export default class FormUtil {
    /**
     * setFormErrors.
     *
     * @param {Object} form - Antd hook instance
     * @param {Object} errorDict - {str: str[]}
     */

    static setFormErrors(form) {
        return (errorDict) => {
            if ("detail" in errorDict) {
                return FormUtil.setPopupErrors(errorDict);
            }
            form &&
                form.setFields(
                    Object.entries(errorDict).map(([name, errors]) => ({
                        name,
                        errors: typeof errors === "string" ? [errors] : errors
                    }))
                );
        };
    }

    /**
     * setPopupErrors.
     *
     * @param {Object} form - Antd hook instance
     * @param {Object} errorDict - {str: str[]}
     */

    static setPopupErrors(errorDict) {
        if ("detail" in errorDict) {
            ElNotification({
                title: "Error",
                message: errorDict.detail[0],
                type: "error"
            });
        }
    }

    /**
     * submit.
     *
     * @param {Object} payload
     */
    static submit(url, payload, method = "post") {
        EventUtil.toggleGlobalLoading();
        return new Promise((resolve, reject) => {
            RequestUtil.apiCall(url, payload, method)
                .then(resolve)
                .catch(reject)
                .finally(() => EventUtil.toggleGlobalLoading(false));
        });
    }

    /**
     * getDefaultFieldName.
     *
     * @param {String} fieldName
     * @returns {String}
     */
    static getDefaultFieldName(fieldName) {
        return fieldName ? `"${fieldName}"` : "này";
    }

    /**
     * ruleRequired.
     *
     * @param {String} fieldName
     * @returns {Object} - Antd Form Rule Object
     */
    static ruleRequired(fieldName = "") {
        fieldName = FormUtil.getDefaultFieldName(fieldName);
        return {
            required: true,
            message: `Trường ${fieldName} là bắt buộc`
        };
    }

    /**
     * ruleEmail.
     *
     * @param {String} fieldName
     * @returns {Object} - Antd Form Rule Object
     */
    static ruleEmail(_fieldName = "") {
        return {
            type: "email",
            message: t`The input is not valid E-mail`
        };
    }

    /**
     * ruleMin.
     *
     * @param {Number} min
     * @param {String} fieldName
     * @returns {Object} - Antd Form Rule Object
     */
    static ruleMin(min, fieldName = "") {
        fieldName = FormUtil.getDefaultFieldName(fieldName);
        return {
            type: "number",
            min,
            message: `Trường "${fieldName}" có giá trị bé nhất là: ${min}`
        };
    }

    /**
     * ruleMax.
     *
     * @param {Number} max
     * @param {String} fieldName
     * @returns {Object} - Antd Form Rule Object
     */
    static ruleMax(max, fieldName = "") {
        fieldName = FormUtil.getDefaultFieldName(fieldName);
        return {
            type: "number",
            max,
            message: `Trường "${fieldName}" có giá trị lớn nhất là: ${max}`
        };
    }
}
