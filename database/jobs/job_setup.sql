--Configures timezone and shared_preload_libraries with pg_cron on AWS
--Excecutes first on a SQL client with access to postgres database

CREATE EXTENSION IF NOT EXISTS pg_cron;

-- Create a job to update the status of positions
SELECT cron.schedule('update_position_status_open', '0 0 * * *',
    $$
    UPDATE public.positions
    SET status = 1
    WHERE status = 2
    AND NOW() BETWEEN "from" AND ("to" + INTERVAL '1 day' - INTERVAL '1 second');
    $$
);

-- Create a job to update the status of positions
SELECT cron.schedule('update_position_status_closed', '0 0 * * *',
    $$
    UPDATE public.positions
    SET status = 2
    WHERE status = 1
    AND (
        NOW() < "from"
        OR NOW() > ("to" + INTERVAL '1 day' - INTERVAL '1 second')
    );
    $$
);

-- Create a job to update the status of position_users on expires
SELECT cron.schedule('update_position_users_expires', '0 0 * * *',
$$
UPDATE public.position_users pu
SET status = -1
WHERE status = 0
AND (
    pu.created_at <= NOW() - INTERVAL '3 weeks'
    OR EXISTS (
        SELECT 1 FROM public.positions p
        WHERE p.id = pu.position_id
        AND p.to < NOW()
    )
);
$$);