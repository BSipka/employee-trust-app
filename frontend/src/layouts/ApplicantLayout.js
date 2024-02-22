import React from "react";
import { Outlet, json, useNavigation } from "react-router-dom";
import ApplicantNavigation from "../components/navigation/ApplicantNavigation";
import { getAuthUser } from "../util/auth";

export default function ApplicantLayout() {
    const navigation = useNavigation();

    console.log("Applicant part loaded ... ");

    return (
        <>
            <ApplicantNavigation />
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
    if (authUser[0].role !== "APPLICANT") {
        throw json({ message: "No access" }, { status: 403 });
    }

    return authUser;
}
