import React from "react";
import {
    Form,
    useActionData,
    useNavigation,
    useSearchParams,
} from "react-router-dom";

export default function AuthForm() {
    const data = useActionData();
    const navigation = useNavigation();

    const [searchParams] = useSearchParams();
    const isLogin = searchParams.get("mode") === "login";

    const isSubmiting = navigation.state === "submitting";
    return (
        <>
            <Form method="post">
                {data && data.errors && (
                    <ul>
                        {Object.values(data.errors).map((err) => {
                            <li key={err}>{err}</li>;
                        })}
                    </ul>
                )}
                {data && data.message && <p>{data.message}</p>}
                <label>Email</label>
                <input type="email" name="email" required />

                <label>Password</label>
                <input type="password" name="password" required />

                <button disabled={isSubmiting}>
                    {isSubmiting ? "Submiting ..." : "Login"}
                </button>
            </Form>
        </>
    );
}
