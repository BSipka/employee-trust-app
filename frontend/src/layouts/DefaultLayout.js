import React from "react";
import { Outlet, useLoaderData } from "react-router-dom";
import MainNavigation from "../components/navigation/MainNavigation";

export default function DefaultLayout() {
   
    return (
        <>
            <MainNavigation />
            <main>
                <Outlet />
            </main>
        </>
    );
}
