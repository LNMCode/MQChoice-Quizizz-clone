import 'dart:async';

import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:mobileapplication/responsitory/stream_socket.dart';
import 'package:mobileapplication/screens/waitroom/blocs/waitroom_bloc.dart';
import 'package:mobileapplication/screens/waitroom/blocs/waitroom_event.dart';
import 'package:mobileapplication/screens/waitroom/blocs/waitroom_state.dart';
import 'package:socket_io_client/socket_io_client.dart' as IO;

// Start connect to socket and insert user
// If have any error -> revert entercode_screen page
class WaitRoomScreen extends StatefulWidget {
  final String iduser;
  final String idroom;
  final String nameuser;

  const WaitRoomScreen({
    Key? key,
    required this.idroom,
    required this.iduser,
    required this.nameuser,
  }) : super(key: key);

  @override
  State<StatefulWidget> createState() => _WaitRoomScreenState();
}

class _WaitRoomScreenState extends State<WaitRoomScreen> {
  StreamSocket? _streamSocket;

  @override
  void initState() {
    super.initState();
    BlocProvider.of<WaitRoomBloc>(context).add(WaitRoomEventConnected());
  }

  @override
  Widget build(BuildContext context) {
    return BlocConsumer<WaitRoomBloc, WaitRoomState>(
      listener: (context, state) {
        if (state is WaitRoomSuccess) {
          _streamSocket = state.streamSocket;
        }
      },
      builder: (context, state) {
        if (_streamSocket != null) {
          return StreamBuilder(
            stream: _streamSocket!.getResponse,
            builder: (context, snapshot) {
              return Container(
                child: Text(
                  snapshot.hasData ? snapshot.data.toString() : "0",
                ),
              );
            },
          );
        }
        return Center(
          child: Column(
            children: [
              Text(widget.iduser),
              Text(widget.idroom),
              Text(widget.nameuser),
            ],
          ),
        );
      },
    );
  }
}
