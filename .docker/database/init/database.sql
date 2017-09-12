--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.5
-- Dumped by pg_dump version 9.6.5

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: uuid-ossp; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS "uuid-ossp" WITH SCHEMA public;


--
-- Name: EXTENSION "uuid-ossp"; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION "uuid-ossp" IS 'generate universally unique identifiers (UUIDs)';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: citizen; Type: TABLE; Schema: public; Owner: pehapkari
--

CREATE TABLE citizen (
    id uuid NOT NULL,
    mother_id uuid,
    father_id uuid,
    name character varying(255) NOT NULL,
    birth_date timestamp(0) without time zone NOT NULL
);


ALTER TABLE citizen OWNER TO pehapkari;

--
-- Name: COLUMN citizen.id; Type: COMMENT; Schema: public; Owner: pehapkari
--

COMMENT ON COLUMN citizen.id IS '(DC2Type:uuid)';


--
-- Name: COLUMN citizen.mother_id; Type: COMMENT; Schema: public; Owner: pehapkari
--

COMMENT ON COLUMN citizen.mother_id IS '(DC2Type:uuid)';


--
-- Name: COLUMN citizen.father_id; Type: COMMENT; Schema: public; Owner: pehapkari
--

COMMENT ON COLUMN citizen.father_id IS '(DC2Type:uuid)';


--
-- Name: COLUMN citizen.birth_date; Type: COMMENT; Schema: public; Owner: pehapkari
--

COMMENT ON COLUMN citizen.birth_date IS '(DC2Type:datetime_immutable)';


--
-- Name: property; Type: TABLE; Schema: public; Owner: pehapkari
--

CREATE TABLE property (
    id uuid NOT NULL,
    address_id uuid,
    type character varying(255) NOT NULL
);


ALTER TABLE property OWNER TO pehapkari;

--
-- Name: COLUMN property.id; Type: COMMENT; Schema: public; Owner: pehapkari
--

COMMENT ON COLUMN property.id IS '(DC2Type:uuid)';


--
-- Name: COLUMN property.address_id; Type: COMMENT; Schema: public; Owner: pehapkari
--

COMMENT ON COLUMN property.address_id IS '(DC2Type:uuid)';


--
-- Name: COLUMN property.type; Type: COMMENT; Schema: public; Owner: pehapkari
--

COMMENT ON COLUMN property.type IS '(DC2Type:string_enum)';


--
-- Name: property_address; Type: TABLE; Schema: public; Owner: pehapkari
--

CREATE TABLE property_address (
    id uuid NOT NULL,
    city character varying(255) NOT NULL,
    street character varying(255) NOT NULL,
    house_number integer NOT NULL,
    postal_code integer NOT NULL
);


ALTER TABLE property_address OWNER TO pehapkari;

--
-- Name: COLUMN property_address.id; Type: COMMENT; Schema: public; Owner: pehapkari
--

COMMENT ON COLUMN property_address.id IS '(DC2Type:uuid)';


--
-- Name: property_ownership; Type: TABLE; Schema: public; Owner: pehapkari
--

CREATE TABLE property_ownership (
    id uuid NOT NULL,
    owner_id uuid,
    property_id uuid
);


ALTER TABLE property_ownership OWNER TO pehapkari;

--
-- Name: COLUMN property_ownership.id; Type: COMMENT; Schema: public; Owner: pehapkari
--

COMMENT ON COLUMN property_ownership.id IS '(DC2Type:uuid)';


--
-- Name: COLUMN property_ownership.owner_id; Type: COMMENT; Schema: public; Owner: pehapkari
--

COMMENT ON COLUMN property_ownership.owner_id IS '(DC2Type:uuid)';


--
-- Name: COLUMN property_ownership.property_id; Type: COMMENT; Schema: public; Owner: pehapkari
--

COMMENT ON COLUMN property_ownership.property_id IS '(DC2Type:uuid)';


--
-- Name: property_residency; Type: TABLE; Schema: public; Owner: pehapkari
--

CREATE TABLE property_residency (
    id uuid NOT NULL,
    resident_id uuid,
    property_id uuid,
    type character varying(255) NOT NULL
);


ALTER TABLE property_residency OWNER TO pehapkari;

--
-- Name: COLUMN property_residency.id; Type: COMMENT; Schema: public; Owner: pehapkari
--

COMMENT ON COLUMN property_residency.id IS '(DC2Type:uuid)';


--
-- Name: COLUMN property_residency.resident_id; Type: COMMENT; Schema: public; Owner: pehapkari
--

COMMENT ON COLUMN property_residency.resident_id IS '(DC2Type:uuid)';


--
-- Name: COLUMN property_residency.property_id; Type: COMMENT; Schema: public; Owner: pehapkari
--

COMMENT ON COLUMN property_residency.property_id IS '(DC2Type:uuid)';


--
-- Name: COLUMN property_residency.type; Type: COMMENT; Schema: public; Owner: pehapkari
--

COMMENT ON COLUMN property_residency.type IS '(DC2Type:string_enum)';


--
-- Data for Name: citizen; Type: TABLE DATA; Schema: public; Owner: pehapkari
--

INSERT INTO citizen (id, mother_id, father_id, name, birth_date) VALUES ('d6f6a52c-6d3b-4ca9-ae50-4e9d955023b0', NULL, NULL, 'Franta Nemam', '1990-05-05 15:50:55');
INSERT INTO citizen (id, mother_id, father_id, name, birth_date) VALUES ('56e05476-3853-4c65-9092-d5fa4d5f1666', NULL, NULL, 'Bender', '1980-05-05 15:50:55');
INSERT INTO citizen (id, mother_id, father_id, name, birth_date) VALUES ('15d162cb-8e43-416d-8043-396b0a7cfd2b', '56e05476-3853-4c65-9092-d5fa4d5f1666', 'd6f6a52c-6d3b-4ca9-ae50-4e9d955023b0', 'Fry', '1980-05-05 15:50:55');


--
-- Data for Name: property; Type: TABLE DATA; Schema: public; Owner: pehapkari
--

INSERT INTO property (id, address_id, type) VALUES ('3c8a6789-fe61-4ae4-8322-2553e2f507a1', '020fafb1-6628-41f4-a688-a1646c0cdd62', 'home');


--
-- Data for Name: property_address; Type: TABLE DATA; Schema: public; Owner: pehapkari
--

INSERT INTO property_address (id, city, street, house_number, postal_code) VALUES ('020fafb1-6628-41f4-a688-a1646c0cdd62', 'Brno', 'Hlavni', 1, 60200);


--
-- Data for Name: property_ownership; Type: TABLE DATA; Schema: public; Owner: pehapkari
--

INSERT INTO property_ownership (id, owner_id, property_id) VALUES ('07c9ac55-aaac-400b-b3a2-f400380b508b', 'd6f6a52c-6d3b-4ca9-ae50-4e9d955023b0', '3c8a6789-fe61-4ae4-8322-2553e2f507a1');
INSERT INTO property_ownership (id, owner_id, property_id) VALUES ('3b55821e-627b-40e7-90ae-3c8ef89dd37f', '56e05476-3853-4c65-9092-d5fa4d5f1666', '3c8a6789-fe61-4ae4-8322-2553e2f507a1');
INSERT INTO property_ownership (id, owner_id, property_id) VALUES ('93e6478a-8602-4b37-88fa-f6ced4833b0b', '15d162cb-8e43-416d-8043-396b0a7cfd2b', '3c8a6789-fe61-4ae4-8322-2553e2f507a1');


--
-- Data for Name: property_residency; Type: TABLE DATA; Schema: public; Owner: pehapkari
--



--
-- Name: citizen citizen_pkey; Type: CONSTRAINT; Schema: public; Owner: pehapkari
--

ALTER TABLE ONLY citizen
    ADD CONSTRAINT citizen_pkey PRIMARY KEY (id);


--
-- Name: property_address property_address_pkey; Type: CONSTRAINT; Schema: public; Owner: pehapkari
--

ALTER TABLE ONLY property_address
    ADD CONSTRAINT property_address_pkey PRIMARY KEY (id);


--
-- Name: property_ownership property_ownership_pkey; Type: CONSTRAINT; Schema: public; Owner: pehapkari
--

ALTER TABLE ONLY property_ownership
    ADD CONSTRAINT property_ownership_pkey PRIMARY KEY (id);


--
-- Name: property property_pkey; Type: CONSTRAINT; Schema: public; Owner: pehapkari
--

ALTER TABLE ONLY property
    ADD CONSTRAINT property_pkey PRIMARY KEY (id);


--
-- Name: property_residency property_residency_pkey; Type: CONSTRAINT; Schema: public; Owner: pehapkari
--

ALTER TABLE ONLY property_residency
    ADD CONSTRAINT property_residency_pkey PRIMARY KEY (id);


--
-- Name: IDX_66C906D1549213EC; Type: INDEX; Schema: public; Owner: pehapkari
--

CREATE INDEX "IDX_66C906D1549213EC" ON property_residency USING btree (property_id);


--
-- Name: IDX_66C906D18012C5B0; Type: INDEX; Schema: public; Owner: pehapkari
--

CREATE INDEX "IDX_66C906D18012C5B0" ON property_residency USING btree (resident_id);


--
-- Name: IDX_697FEE29549213EC; Type: INDEX; Schema: public; Owner: pehapkari
--

CREATE INDEX "IDX_697FEE29549213EC" ON property_ownership USING btree (property_id);


--
-- Name: IDX_697FEE297E3C61F9; Type: INDEX; Schema: public; Owner: pehapkari
--

CREATE INDEX "IDX_697FEE297E3C61F9" ON property_ownership USING btree (owner_id);


--
-- Name: IDX_8BF21CDEF5B7AF75; Type: INDEX; Schema: public; Owner: pehapkari
--

CREATE INDEX "IDX_8BF21CDEF5B7AF75" ON property USING btree (address_id);


--
-- Name: IDX_A95317292055B9A2; Type: INDEX; Schema: public; Owner: pehapkari
--

CREATE INDEX "IDX_A95317292055B9A2" ON citizen USING btree (father_id);


--
-- Name: IDX_A9531729B78A354D; Type: INDEX; Schema: public; Owner: pehapkari
--

CREATE INDEX "IDX_A9531729B78A354D" ON citizen USING btree (mother_id);


--
-- Name: property_residency FK_66C906D1549213EC; Type: FK CONSTRAINT; Schema: public; Owner: pehapkari
--

ALTER TABLE ONLY property_residency
    ADD CONSTRAINT "FK_66C906D1549213EC" FOREIGN KEY (property_id) REFERENCES property(id);


--
-- Name: property_residency FK_66C906D18012C5B0; Type: FK CONSTRAINT; Schema: public; Owner: pehapkari
--

ALTER TABLE ONLY property_residency
    ADD CONSTRAINT "FK_66C906D18012C5B0" FOREIGN KEY (resident_id) REFERENCES citizen(id);


--
-- Name: property_ownership FK_697FEE29549213EC; Type: FK CONSTRAINT; Schema: public; Owner: pehapkari
--

ALTER TABLE ONLY property_ownership
    ADD CONSTRAINT "FK_697FEE29549213EC" FOREIGN KEY (property_id) REFERENCES property(id);


--
-- Name: property_ownership FK_697FEE297E3C61F9; Type: FK CONSTRAINT; Schema: public; Owner: pehapkari
--

ALTER TABLE ONLY property_ownership
    ADD CONSTRAINT "FK_697FEE297E3C61F9" FOREIGN KEY (owner_id) REFERENCES citizen(id);


--
-- Name: property FK_8BF21CDEF5B7AF75; Type: FK CONSTRAINT; Schema: public; Owner: pehapkari
--

ALTER TABLE ONLY property
    ADD CONSTRAINT "FK_8BF21CDEF5B7AF75" FOREIGN KEY (address_id) REFERENCES property_address(id);


--
-- Name: citizen FK_A95317292055B9A2; Type: FK CONSTRAINT; Schema: public; Owner: pehapkari
--

ALTER TABLE ONLY citizen
    ADD CONSTRAINT "FK_A95317292055B9A2" FOREIGN KEY (father_id) REFERENCES citizen(id);


--
-- Name: citizen FK_A9531729B78A354D; Type: FK CONSTRAINT; Schema: public; Owner: pehapkari
--

ALTER TABLE ONLY citizen
    ADD CONSTRAINT "FK_A9531729B78A354D" FOREIGN KEY (mother_id) REFERENCES citizen(id);


--
-- PostgreSQL database dump complete
--

