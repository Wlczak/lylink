export class JellyfinApi {
    static getPlaybackInfo(address: string, token: string): Promise<Response> {
        return fetch(address + "/getPlaybackInfo", {
            method: "POST",
            body: JSON.stringify({ token: token }),
        });
    }

    static getEpisodeWithParents(address: string, token: string, mediaId: string): Promise<Response> {
        return fetch(address + "/Episode/WithParents/" + mediaId, {
            method: "POST",
            body: JSON.stringify({ token: token }),
        });
    }

    static async getEpisodeInfo(address: string, token: string, mediaId: string) {
        let res = await fetch(address + "/Episode/" + mediaId, {
            method: "POST",
            body: JSON.stringify({ token: token }),
        });
        res = await res.json();
        console.log(res);
    
    }
}
