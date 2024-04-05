
declare namespace App.Models {

    export interface Statistic {
        name: string;
        stat: string;
        previousStat: string;
        changeType: string;
        change: number;
    }
    export interface BarChart {
        total: number;
        change: number;
        average: number;
        utilization_rate: number;
        current: { x: string, y: number }[];
        previous: { x: string, y: number }[];
    }
    export interface LineChart {
        x: string;
        y: number;
    }
}
