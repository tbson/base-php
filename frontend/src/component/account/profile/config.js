import RequestUtil from "util/request_util";

const urlMap = {
    base: {
        prefix: "account/profile",
        endpoints: {
            profile: ""
        }
    },
    basicAuth: {
        prefix: "auth/basic-auth",
        endpoints: {
            changePwd: "change-pwd"
        }
    }
};

export const urls = RequestUtil.prefixMapValues(urlMap.base);
export const basicAuthUrls = RequestUtil.prefixMapValues(urlMap.basicAuth);
