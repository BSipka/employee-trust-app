import { createBrowserRouter } from "react-router-dom";
import DefaultLayout from "./layouts/DefaultLayout";
import HomePage from "./pages/Home";
import LoginPage from "./pages/Login";
import ErrorPage from "./pages/Error";
import AdminLayout from "./layouts/AdminLayout";
import UsersPage from "./pages/Admin/Users/Users";
import AddUserPage from "./pages/Admin/Users/AddUser";
import axios from "axios";

export const router = createBrowserRouter([
    {
        path: "/",
        element: <DefaultLayout />,
        errorElement: <ErrorPage />,
        children: [
            {
                path: "/",
                element: <HomePage />,
                index: true,
            },
            {
                path: "/login",
                element: <LoginPage />,
            },
        ],
    },
    {
        path: "/admin",
        element: <AdminLayout />,
        children: [
            {
                path: "users",
                index: true,
                element: <UsersPage />,
                loader: async () => {
                    const res = await fetch("http://localhost:8000/api/users");
                    const resData = await res.json();
                    return resData;
                },
            },
            {
                path: "users/new",
                index: true,
                element: <AddUserPage />,
            },
        ],
    },
]);
