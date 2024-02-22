import React from "react";
import { Outlet, useNavigation } from "react-router-dom";
import AdminNavigation from "../components/navigation/AdminNavigation";

export default function AdminLayout() {
    const navigation = useNavigation();

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
