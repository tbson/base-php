import EventUtil from "util/event_util";
import StorageUtil from "util/storage_util";
import RequestUtil from "util/request_util";

export default class NavUtil {
    /**
     * navigateTo.
     *
     * @param {String} path
     * @param {Object} params
     * @param {Query} params
     */
    static navigateTo(router) {
        return (path, query = {}) => router.push({ path, query });
    }

    /**
     * logout.
     *
     * @param {Navigate} navigate
     */
    static logout(navigate) {
        return () => {
            const baseUrl = RequestUtil.getApiBaseUrl();
            const logoutUrl = `${baseUrl}auth/common-auth/logout/`;
            EventUtil.toggleGlobalLoading();
            const payload = {};
            RequestUtil.apiCall(logoutUrl, payload, "post")
                .then(() => {
                    NavUtil.cleanAndMoveToLoginPage();
                })
                .finally(() => {
                    EventUtil.toggleGlobalLoading(false);
                });
        };
    }

    /**
     * cleanAndMoveToLoginPage.
     *
     * @returns {void}
     */
    static cleanAndMoveToLoginPage() {
        let currentUrl = window.location.href.split("://")[1].split("/");
        currentUrl.shift();
        currentUrl = "/" + currentUrl.join("/");
        StorageUtil.removeStorage("auth");
        let loginUrl = "/login";
        if (currentUrl) {
            loginUrl = `${loginUrl}?next=${currentUrl}`;
        }
        console.log(loginUrl);
        window.location.href = loginUrl;
    }
}
