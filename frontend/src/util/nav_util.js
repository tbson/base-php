import EventUtil from "util/event_util";
import StorageUtil from "util/storage_util";
import RequestUtil from "util/request_util";
import { PROFILE_TYPE } from "src/const";

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
                    NavUtil.cleanAndMoveToLoginPage(navigate);
                })
                .finally(() => {
                    EventUtil.toggleGlobalLoading(false);
                });
        };
    }

    /**
     * cleanAndMoveToLoginPage.
     *
     * @param {Navigate} navigate
     * @returns {void}
     */
    static cleanAndMoveToLoginPage(navigate) {
        const currentUrl = window.location.href.split("#")[1];
        const profileType = StorageUtil.getStorageObj("auth").profile_type;
        const orgUid = StorageUtil.getStorageObj("auth").org_uid;
        StorageUtil.removeStorage("auth");
        let loginUrl =
            profileType === PROFILE_TYPE.vendor ? "/login" : `/login/${orgUid}`;
        if (!orgUid) {
            loginUrl = "/login";
        }
        if (currentUrl) {
            loginUrl = `${loginUrl}?next=${currentUrl}`;
        }
        if (navigate) {
            NavUtil.navigateTo(router)(loginUrl);
        } else {
            window.location.href = loginUrl;
        }
    }
}
