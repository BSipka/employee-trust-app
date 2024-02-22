import React from "react";
import { Outlet, useNavigation } from "react-router-dom";

export default function ApplicantLayout() {
    const navigation = useNavigation();

    return (
        <>
            {/* <ApplicantNavigation /> */}
            <main>
                {navigation.state === "loading" && <p>Page is loading ... </p>}
                <Outlet />
            </main>
        </>
    );
}
