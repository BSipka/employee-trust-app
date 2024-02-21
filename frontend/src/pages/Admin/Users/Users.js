import React from "react";
import UsersList from "../../../components/UsersList";
import { useLoaderData } from "react-router-dom";

export default function UsersPage() {
    const users = useLoaderData();

    return <UsersList users={users} />;
}

export async function loadUsers() {
    const res = await fetch("http://localhost:8000/api/users");
    if (res.status !== 200) {
        return new Error();
    }
    const resData = await res.json();
    return resData;
}
