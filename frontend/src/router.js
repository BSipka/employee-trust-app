import { createBrowserRouter } from "react-router-dom";
import DefaultLayout from "./layouts/DefaultLayout";
import HomePage from "./pages/Home";
import ErrorPage from "./pages/Error";
import AdminLayout from "./layouts/AdminLayout";
import UsersPage, { loadUsers } from "./pages/Admin/Users/Users";
import AddUserPage from "./pages/Admin/Users/AddUser";
import AuthenticationPage, {
    action as authAction,
} from "./pages/Authentication";
import { action as logoutAction } from "./pages/Logout";
import { tokenLoader } from "./util/auth";

export const router = createBrowserRouter([
    {
        path: "/",
        element: <DefaultLayout />,
        id: "default",
        loader: tokenLoader,
        errorElement: <ErrorPage />,
        children: [
            {
                path: "/",
                element: <HomePage />,
                index: true,
            },
            {
                path: "auth",
                element: <AuthenticationPage />,
                action: authAction,
            },

            {
                path: "/logout",
                action: logoutAction,
            },
            {
                path: "/users",
                element: <UsersPage />,
                loader: loadUsers,
            },
        ],
    },
    {
        path: "/admin",
        element: <AdminLayout />,
        errorElement: <ErrorPage />,
        children: [
            {
                path: "users/new",

                element: <AddUserPage />,
            },
        ],
    },
]);
