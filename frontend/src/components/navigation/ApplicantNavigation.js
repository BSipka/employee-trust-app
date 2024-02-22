import React from "react";
import { Form, NavLink } from "react-router-dom";
import classes from "./MainNavigation.module.css";

export default function ApplicantNavigation() {
    return (
        <header className={classes.header}>
            <nav>
                <ul className={classes.list}>
                    <li>
                        <NavLink
                            to="/applicant"
                            className={({ isActive }) =>
                                isActive ? classes.active : undefined
                            }
                            end
                        >
                            Home
                        </NavLink>
                    </li>

                    <li>
                        <Form action="/logout" method="post">
                            <button>Logout</button>
                        </Form>
                    </li>
                </ul>
            </nav>
        </header>
    );
}
