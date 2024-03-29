import React from "react";
import AuthForm from "../components/AuthForm";
import { json, redirect } from "react-router-dom";

export default function AuthenticationPage() {
    return <AuthForm />;
}

export async function action({ request }) {
    const searchParams = new URL(request.url).searchParams;
    const mode = searchParams.get("mode") || "login";

    if (mode !== "login" && mode !== "signup") {
        throw json({ message: "Unsuported mode." }, { status: 422 });
    }

    const data = await request.formData();
    const authData = {
        email: data.get("email"),
        password: data.get("password"),
    };

    const response = await fetch("http://localhost:8000/api/" + mode, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(authData),
    });
    console.log(response);
    if (response.status === 422 || response.status === 401) {
        return response;
    }

    if (!response.ok) {
        throw json({ message: "Authentication failed" }, { status: 500 });
    }

    const resData = await response.json();

    localStorage.setItem(
        "auth_user",
        JSON.stringify([resData.user, resData.token])
    );

    return redirect(`/${resData.user.role.toLowerCase()}`);
}
