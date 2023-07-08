export function usePusher() {
    let pusher = new Pusher('50150a51e851f6d94639', {
        cluster: 'eu'
    });

    return { pusher };
}