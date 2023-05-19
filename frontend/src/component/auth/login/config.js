import RequestUtil from "util/request_util";

const urlMap = {
    basicAuth: {
        prefix: "auth/basic-auth",
        endpoints: {
            login: "login",
            resetPassword: "reset-pwd",
            changePassword: "change-pwd"
        }
    },
    commonAuth: {
        prefix: "auth/common-auth",
        endpoints: {
            logout: "logout",
            refreshToken: "refresh-token",
            refreshCheck: "refresh-check"
        }
    }
};

export const basicAuthUrls = RequestUtil.prefixMapValues(urlMap.basicAuth);
export const commonAuthUrls = RequestUtil.prefixMapValues(urlMap.commonAuth);
