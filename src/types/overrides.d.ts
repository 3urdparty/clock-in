
declare namespace App.Models {
    export interface Employee extends App.Models.Employee {
        status: "online" | "offline";
    }

    declare interface Shift extends App.Models.Shift {
        start: number;
    }
}
