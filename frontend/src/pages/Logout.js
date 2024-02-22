import { redirect } from "react-router-dom";

export function action() {
    localStorage.removeItem("auth_user");
    return redirect("/");
}
