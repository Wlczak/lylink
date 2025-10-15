import { JellyfinApi } from "./jellyfinApi.js";

export class JellyfinEdit {
    static setUp(address: string, token: string) {
        const mediaId = new URLSearchParams(window.location.search).get("ep_id");
        if (mediaId == null || mediaId == undefined || mediaId == "") {
            console.error("No mediaId found");
            return;
        }

        JellyfinApi.getEpisodeInfo(address, token, mediaId);
    }
}
