import RequestUtil from "util/request_util";

const urlMap = {
    base: {
        prefix: "auth/basic-auth",
        endpoints: {
            login: "login",
            resetPassword: "reset-pwd",
            changePassword: "change-pwd"
        }
    }
};

export const urls = RequestUtil.prefixMapValues(urlMap.base);
