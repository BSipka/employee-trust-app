import React from "react";
import UsersList from "../../../components/UsersList";
import { json, useLoaderData } from "react-router-dom";

export default function UsersPage() {
    const users = useLoaderData();

    return <UsersList users={users} />;
}

export async function loadUsers() {
    const res = await fetch("http://localhost:8000/api/userss");
    if (res.status !== 200) {
        throw json({ message: "Could not load users." }, { status: 500 });
    }
    const resData = await res.json();
    return resData;
}
