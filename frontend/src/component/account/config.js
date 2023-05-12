import RequestUtil from "util/request_util";

const urlMap = {
    base: {
        prefix: "account/profile",
        endpoints: {
            profile: ""
        }
    }
};

export const urls = RequestUtil.prefixMapValues(urlMap.base);
