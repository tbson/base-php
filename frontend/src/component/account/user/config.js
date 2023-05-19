import RequestUtil from "util/request_util";

const urlMap = {
    base: {
        prefix: "account/profile",
        endpoints: {
            crud: ""
        }
    }
};

export const urls = RequestUtil.prefixMapValues(urlMap.base);

const headingTxt = "User";
const name = headingTxt.toLowerCase();
export const messages = {
    heading: headingTxt,
    deleteOne: `Do you want to remote this ${name}?`,
    deleteMultiple: `Do you want to remote these ${name}?`
};
