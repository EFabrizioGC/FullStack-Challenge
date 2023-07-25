import requestHandler from "@/lib/request-handler";

class UserApi {
  all(page: number = 1) {
    return requestHandler.get(`users?page=${page}`);
  }

  show(id: number) {
    return requestHandler.get(`users/${id}`);
  }
}

export default new UserApi();
