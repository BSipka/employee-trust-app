import React from "react";
import { Form } from "react-router-dom";

export default function AuthForm() {
    return (
        <>
            <Form method="post">
                <label>Email</label>
                <input type="email" name="email" required />

                <label>Password</label>
                <input type="password" name="password" required />

                <button>Login</button>
            </Form>
        </>
    );
}
