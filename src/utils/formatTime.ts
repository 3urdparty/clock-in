
const pad = (n: number) => (n.toString().length <= 1 ? "0" : "") + n.toString();
export const formatTime = (time: number) =>
    `${pad(Math.floor(time))}:${pad(Math.floor((time - Math.floor(time)) * 60))}`;
