import RequestUtil from "util/request_util";

const urlMap = {
    base: {
        prefix: "config/variable",
        endpoints: {
            crud: ""
        }
    }
};

export const urls = RequestUtil.prefixMapValues(urlMap.base);

const headingTxt = "Variable";
const name = headingTxt.toLowerCase();
export const messages = {
    heading: headingTxt,
    deleteOne: `Do you want to remote this ${name}?`,
    deleteMultiple: `Do you want to remote these ${name}?`
};
