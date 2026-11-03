import { Button, Space, Form, Input } from 'antd';
import React, { useEffect, useState } from 'react';
import { AiOutlineMail } from 'react-icons/ai';
import AuthLayout from './AuthLayout';
import axios from 'axios';
import Routes from '../../../common/helpers/Routes';
import Utils from '../../../common/helpers/Utils';
import { Link, useHistory, useLocation } from 'react-router-dom';
import { useSelector } from 'react-redux';

const ForgetPassword = () => {
    const [loading, setLoading] = useState(false);
    const {siteName, apiToken, demoMode} = useSelector(state => state.globalState);
    let history = useHistory();
    let location = useLocation();

    useEffect(() => {
        document.title = `Lupa Kata Sandi - ${siteName}`;
    }, [])

    useEffect(() => {
        if (apiToken) {
            let { from } = location.state || { from: { pathname: Routes.web.admin.dashboard } };
            history.push(from);
        }
    }, [apiToken]);

    const onSubmit = (values) => {
        if (demoMode) {
            Utils.showNotification('Fitur ini tidak tersedia dalam mode Demo', 'warning');
            return;
        }
        setLoading(true);
        
        axios.post(Routes.api.admin.forgetPassword, {
            email: values.email,
        })
        .then(response => {
            Utils.handleSuccessResponse(response, () => {
                Utils.showNotification(response.data.message, 'success', null, true);
                history.push(Routes.web.admin.login);
            });
        })
        .catch((error) => {
            Utils.handleException(error);
        }).finally(() => {
            setLoading(false);
        });
    };

    return (
        <React.Fragment>
            <AuthLayout title={'LUPA KATA SANDI'}>
                <Form
                    name="forgetPassword"
                    onFinish={onSubmit}
                >
                    <Form.Item
                        name="email"
                        rules={[
                            {
                                required: true,
                                message: 'Silakan masukkan email Anda'
                            },
                            {
                                type: 'email',
                                message: 'Format alamat email tidak valid'
                            }
                        ]}
                    >
                        <Input prefix={<AiOutlineMail />} placeholder="Email" />
                    </Form.Item>
                    <Form.Item>
                        <Space direction="vertical" style={{width: '100%'}}>
                            <Button type="primary" htmlType="submit" block loading={loading}>
                                Send Reset Email
                            </Button>
                            
                            <Button type="default" htmlType="button" block disabled={loading}>
                                <Link to={Routes.web.admin.login}>Kembali ke Masuk</Link>
                            </Button>
                        </Space>
                    </Form.Item>
                </Form>
            </AuthLayout>
        </React.Fragment>
    )
}

export default ForgetPassword;