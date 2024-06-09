create table migrations
(
    id        serial,
    migration varchar(255) not null,
    batch     integer      not null,
    primary key (id)
);

create table users
(
    id                bigserial,
    email             varchar(255) not null,
    email_verified_at timestamp(0),
    name              varchar(255) not null,
    surname           varchar(255) not null,
    password          varchar(255) not null,
    remember_token    varchar(100),
    created_at        timestamp(0),
    updated_at        timestamp(0),
    primary key (id),
    constraint users_email_unique
        unique (email)
);

create table password_reset_tokens
(
    email      varchar(255) not null,
    token      varchar(255) not null,
    created_at timestamp(0),
    primary key (email)
);

create table sessions
(
    id            varchar(255) not null,
    user_id       bigint,
    ip_address    varchar(45),
    user_agent    text,
    payload       text         not null,
    last_activity integer      not null,
    primary key (id)
);

create index sessions_user_id_index
    on sessions (user_id);

create index sessions_last_activity_index
    on sessions (last_activity);

create table oauth_auth_codes
(
    id         varchar(100) not null,
    user_id    bigint       not null,
    client_id  bigint       not null,
    scopes     text,
    revoked    boolean      not null,
    expires_at timestamp(0),
    primary key (id)
);

create index oauth_auth_codes_user_id_index
    on oauth_auth_codes (user_id);

create table oauth_access_tokens
(
    id         varchar(100) not null,
    user_id    bigint,
    client_id  bigint       not null,
    name       varchar(255),
    scopes     text,
    revoked    boolean      not null,
    created_at timestamp(0),
    updated_at timestamp(0),
    expires_at timestamp(0),
    primary key (id)
);

create index oauth_access_tokens_user_id_index
    on oauth_access_tokens (user_id);

create table oauth_refresh_tokens
(
    id              varchar(100) not null,
    access_token_id varchar(100) not null,
    revoked         boolean      not null,
    expires_at      timestamp(0),
    primary key (id)
);

create index oauth_refresh_tokens_access_token_id_index
    on oauth_refresh_tokens (access_token_id);

create table oauth_clients
(
    id                     bigserial,
    user_id                bigint,
    name                   varchar(255) not null,
    secret                 varchar(100),
    provider               varchar(255),
    redirect               text         not null,
    personal_access_client boolean      not null,
    password_client        boolean      not null,
    revoked                boolean      not null,
    created_at             timestamp(0),
    updated_at             timestamp(0),
    primary key (id)
);

create index oauth_clients_user_id_index
    on oauth_clients (user_id);

create table oauth_personal_access_clients
(
    id         bigserial,
    client_id  bigint not null,
    created_at timestamp(0),
    updated_at timestamp(0),
    primary key (id)
);

create table sports
(
    id         bigserial,
    name       varchar(255) not null,
    created_at timestamp(0),
    updated_at timestamp(0),
    primary key (id),
    constraint sports_name_unique
        unique (name),
    constraint sports_name_check
        check ((name)::text = ANY
               ((ARRAY ['Tenis'::character varying, 'Paddle'::character varying, 'Futbol'::character varying, 'Baloncesto'::character varying, 'Voleibol'::character varying])::text[]))
);

create table fields
(
    id         bigserial,
    sport_id   bigint not null,
    created_at timestamp(0),
    updated_at timestamp(0),
    primary key (id),
    constraint fields_sport_id_foreign
        foreign key (sport_id) references sports
            on delete cascade
);

create table members
(
    id         bigserial,
    email      varchar(255) not null,
    name       varchar(255) not null,
    surname    varchar(255) not null,
    dni        varchar(255) not null,
    created_at timestamp(0),
    updated_at timestamp(0),
    primary key (id),
    constraint members_email_unique
        unique (email)
);

create table bookings
(
    id         bigserial,
    date       timestamp(0) with time zone not null,
    member_id  bigint                      not null,
    field_id   bigint                      not null,
    created_at timestamp(0),
    updated_at timestamp(0),
    primary key (id),
    constraint bookings_member_id_foreign
        foreign key (member_id) references members
            on delete cascade,
    constraint bookings_field_id_foreign
        foreign key (field_id) references fields
            on delete cascade
);


