import React from 'react';
import { Result, Button } from 'antd';
import { Link } from 'react-router-dom';
import styled from 'styled-components';
import Routes from '../../common/helpers/Routes';

// Create a Wrapper component that'll render an <section> tag with some styles
const Wrapper = styled.section`
    margin-top: 30px;
`;

/**
 * Display not found page
 */
const NotFound = () => {
    return (
        <Wrapper>
            <Result
                status="404"
                title="404"
                subTitle="Maaf, halaman yang Anda tuju tidak ditemukan."
                extra={<Button type="primary"><Link to={Routes.web.admin.admin}>Kembali ke Beranda</Link></Button>}
            />
        </Wrapper>
    )
}

export default NotFound;