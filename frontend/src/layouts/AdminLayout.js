import React from "react";
import { Outlet, json, useNavigation } from "react-router-dom";
import AdminNavigation from "../components/navigation/AdminNavigation";
import { getAuthUser } from "../util/auth";

export default function AdminLayout() {
    const navigation = useNavigation();

    console.log("Admin part loaded ... ");
    return (
        <>
            <AdminNavigation />
            <main>
                {navigation.state === "loading" && <p>Page is loading ... </p>}
                <Outlet />
            </main>
        </>
    );
}

export function loader() {
    const authUser = getAuthUser();

    if (authUser === null) {
        throw json({ message: "Unauthorized" }, { status: 401 });
    }
    if (authUser[0].role !== "ADMIN") {
        throw json({ message: "No access" }, { status: 403 });
    }

    return authUser;
}
