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
                path: "auth",
                element: <AuthenticationPage />,
                action: authAction,
            },
        ],
    },
    {
        path: "/admin",
        element: <AdminLayout />,
        errorElement: <ErrorPage />,
        children: [
            {
                path: "users",
                index: true,
                element: <UsersPage />,
                loader: loadUsers,
            },
            {
                path: "users/new",

                element: <AddUserPage />,
            },
        ],
    },
]);
