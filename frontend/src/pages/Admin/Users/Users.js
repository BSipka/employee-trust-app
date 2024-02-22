import React from "react";
import UsersList from "../../../components/UsersList";
import { json, useLoaderData } from "react-router-dom";
import api from "../../../util/api";

export default function UsersPage() {
    const users = useLoaderData();

    return <UsersList users={users} />;
}

export async function loadUsers() {
    const res = api.get("/admin/users").then((response) => {
        if (response.status !== 200) {
            throw json({ message: "Could not load users." }, { status: 500 });
        }

        return response.data.users;
    });

    return res;
}
