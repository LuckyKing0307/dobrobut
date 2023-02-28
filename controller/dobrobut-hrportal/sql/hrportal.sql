CREATE TABLE public.organizations (
      id uuid NOT NULL,
      cd timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      active bool NOT NULL default true,
      "name" varchar NOT NULL,
      CONSTRAINT organizations_pk PRIMARY KEY (id)
);

CREATE TABLE public.positions (
      id uuid NOT NULL,
      cd timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      "name" varchar NOT NULL,
      CONSTRAINT positions_pk PRIMARY KEY (id)
);

CREATE TABLE public.personal_types (
       id uuid NOT NULL,
       cd timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
       active bool NOT NULL default true,
       "name" varchar NOT NULL,
       CONSTRAINT personal_types_pk PRIMARY KEY (id)
);

CREATE TABLE public.departments (
        id uuid NOT NULL,
        cd timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        active bool NOT NULL default true,
        "name" varchar NOT NULL,
        parent_id uuid,
        organization_id uuid,
        "header" int,
        CONSTRAINT departments_pk PRIMARY KEY (id)
);

CREATE TABLE public.personal_directions (
       id uuid NOT NULL,
       cd timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
       active bool NOT NULL default true,
       "name" varchar NOT NULL,
       "header" int,
       "sort" varchar,
       CONSTRAINT personal_directions_pk PRIMARY KEY (id)
);

CREATE TABLE public.users (
      id uuid NOT NULL,
      cd timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      active bool NOT NULL default true,
      "login" varchar NOT NULL,
      "last_name" varchar NOT NULL,
      "name" varchar NOT NULL,
      "second_name" varchar,
      "phone" varchar,
      "email" varchar,
      "birthday" varchar,
      "gender" varchar,
      "work_phone" varchar,
      "uf_phone_inner" varchar,
      CONSTRAINT users_pk PRIMARY KEY (id)
);

CREATE TABLE public.user_positions (
       id uuid NOT NULL,
       cd timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
       user_id uuid NOT NULL,
       ORGANIZATION_ID uuid NOT NULL,
       DEPARTMENT_ID uuid NOT NULL,
       POSITION_ID uuid NOT NULL,
       POSITION_TYPE uuid NOT NULL,
       DIRECTION uuid,
       POST_TYPE varchar,
       CONSTRAINT user_positions_pk PRIMARY KEY (id)
);

CREATE INDEX user_positions_user_id_idx ON public.user_positions (user_id);